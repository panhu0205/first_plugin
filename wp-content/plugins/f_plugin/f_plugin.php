<?php

/*
Plugin Name: First plugin
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Me
Version: 0.0.1
Author URI: http://google.com/
Text Domain: wcpdomain
Domain Path: /languages
*/

class WordCountAndTimePlugin{
    function __construct(){
        add_action('admin_menu', array($this, 'adminPage'));
        add_action('admin_init', array($this, 'settings'));
        add_filter('the_content', array($this, 'ifWrap'));
        add_action('init', array($this, 'languages'));
    }

    function languages(){
        load_plugin_textdomain('wcpdomain', false, dirname(plugin_basename(__FILE__)). '/languages');
    }

    function ifWrap($content){
        if((is_main_query() AND is_single()) AND (get_option('wcp_wordcount', '1') OR get_option('wcp_charactercount', '1') OR get_option('wcp_readtime', '1'))){
            return $this->createHTML($content);
        }
        return $content;
    }

    function createHTML($content){
        $html = '<h3>' . esc_html(get_option('wcp_headline', 'Post Statistics')) . '</h3><p>';

        // get word count once because both wordcount and readtime will need it.
        if (get_option('wcp_wordcount','1') OR get_option('wcp_readtime','1')){
            $wordCount = str_word_count(strip_tags($content));
        }

        if (get_option('wcp_wordcount','1')){
            $html .= __('This post has','wcpdomain') . ' ' . $wordCount .' '. __('words','wcpdomain') . '.<br>';
        }

        if (get_option('wcp_charactercount','1')){
            $html .= 'This post has ' . strlen(strip_tags($content)) . ' characters.<br>';
        }

        if (get_option('wcp_wordcount','1')){
            $html .= 'This post will take about ' . round($wordCount/225) . ' minute(s) to read.<br>';
        }

        $html .= '</p>';

        if(get_option('wcp_location','0') == '0'){
            return $html . $content;
        }
        return $content . $html;
    }

    function settings(){
        add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

        add_settings_field('wcp_location','Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));

        add_settings_field('wcp_headline','Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
        register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));

        add_settings_field('wcp_wordcount','Word Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section',array('theName' => 'wcp_wordcount'));
        register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        add_settings_field('wcp_charactercount','Character Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section',array('theName' => 'wcp_charactercount'));
        register_setting('wordcountplugin', 'wcp_charactercount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

        add_settings_field('wcp_readtime','Read Time', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section',array('theName' => 'wcp_readtime'));
        register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
    }

    function sanitizeLocation($input){
        if ($input != 0 AND $input !=1){
            add_settings_error('wcp_location', 'wcp_location_error','Display location must be top or bottom');
            return get_option('wcp_location');
        }else{
            return $input;
        }
    }

    function locationHTML(){ ?>
        <select name='wcp_location'>
        <option value = '0'> Top </option>
        <option value = '1'> Bottom </option>
        </select>    

    <?php }

    function headlineHTML(){ ?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline'))?>">
        
            <?php
            $args = array(
                'post_type'      => 'wporg_ccgidey',
                'posts_per_page' => 10,
            );

            $loop = new WP_Query($args);
            while ( $loop->have_posts() ) {
                $loop->the_post();
                ?>
                <div class="entry-content">
                    <?php the_title(); ?>
                    <?php the_content(); ?>
                </div>
                <?php
            }
                ?>
                <div class="entry-content">
                    WTF
                </div>
                <?php
            ?>
    <?php }

    function wordcountHTML(){ ?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount','1'))?>>
    <?php }

    function checkboxHTML($args){ ?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName'],'1'))?>>
    <?php }

    function adminPage(){
        add_options_page('Word Count Settings', __('Word Count','wcpdomain'), 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
    }
    
    function ourHTML(){ ?>
        <div class= wrap>
            <h1>
                Word Count Settings
            </h1>
            <form action= "options.php", method = POST>
                <?php
                    settings_fields('wordcountplugin');
                    do_settings_sections('word-count-settings-page');
                    submit_button();
                ?>
            </form>
        </div>
        <?php }
}

function wporg_custom_post_type() {
    register_post_type('wporg_ccgidey',
        array(
            'labels'      => array(
                'name'          => __('Quaos', 'textdomain'),
                'singular_name' => __('Quao', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
        )
    );
}
add_action('init', 'wporg_custom_post_type');

$wordCountAndTimePlugin = new WordCountAndTimePlugin();
