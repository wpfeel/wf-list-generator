<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The Setting functionality of the admin setting menu.
 *
 * Define all functionality of settings page
 *
 * @since 1.0.0
 */
class WFLG_Settings {

    public function __construct() {
        add_action('init', 'wflg_get_options_tabs');
    }

    /**
     * Get setting tab items.
     *
     * @since    1.0.0
     * @return array
     */
    public function wflg_get_options_tabs() {
        $settings = array(
            array(
                'title' => __( 'General', 'wf-list-generator' ),
                'slug' => 'general',
                'class' => array('nav-item','nav-link', 'active')
            ),
            array(
                'title' => __( 'Post', 'wf-list-generator' ),
                'slug' => 'post',
                'class' => array('nav-item', 'nav-link')
            ),
            array(
                'title' => __( 'Page', 'wf-list-generator' ),
                'slug' => 'page',
                'class' => array('nav-item', 'nav-link')
            ),
            array(
                'title' => __( 'Author', 'wf-list-generator' ),
                'slug' => 'author',
                'class' => array('nav-item', 'nav-link')
            ),

        );
        return apply_filters('wflg_options_tabs', $settings);

    }
}