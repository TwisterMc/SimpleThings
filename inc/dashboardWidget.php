<?php
/**
 * Custom Login
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function simpleThings_widget( $wp_customize ) {
    $wp_customize->add_section(
        'simpleThings_widget',
        array(
            'title' => 'Custom Dashboard Widget',
            'description' => 'Add a widget to the dashboard with your own contents.',
            'priority' => 35,
        )
    );

    /* Widget Title */

    $wp_customize->add_setting(
        'simpleThings_widget_title',
        array(
            'default' => 'SimpleThings Widget',
        )

    );

    $wp_customize->add_control(
        'simpleThings_widget_title',
        array(
            'label' => 'Widget Title',
            'section' => 'simpleThings_widget',
            'type' => 'text',
        )
    );

    /* Widget Text Area */

    $wp_customize->add_setting(
        'simpleThings_widget_text',
        array(
            'default' => '',
        )

    );

    $wp_customize->add_control(
        'simpleThings_widget_text',
        array(
            'label' => 'Widget Text',
            'section' => 'simpleThings_widget',
            'type' => 'textarea',
            'description' => 'Paragraph tags automatically added. HTML allowed.',
        )
    );

    /* Hide Widgets */
    $wp_customize->add_setting(
        'simpleThings_hide_widgets'
    );

    $wp_customize->add_control(
        'simpleThings_hide_widgets',
        array(
            'type' => 'checkbox',
            'label' => 'Hide unnecessary widgets?',
            'section' => 'simpleThings_widget',
        )
    );
}
add_action( 'customize_register', 'simpleThings_widget' );

/*-----------------------------------------------------------------------------------*/
/* Add instructions widget
/*-----------------------------------------------------------------------------------*/
function simpleThings_add_dashboard_widgets() {
    $simpleThings_widgetTitle = 'Simple Things Widget';
    if (get_theme_mod( 'simpleThings_widget_title') ) {
        $simpleThings_widgetTitle = get_theme_mod( 'simpleThings_widget_title');
    }
    wp_add_dashboard_widget(
        'simpleThings_dashboard_widget',         // Widget slug.
        $simpleThings_widgetTitle,         // Title.
        'simpleThings_dashboard_widget_function' // Display function.
    );
}
add_action( 'wp_dashboard_setup', 'simpleThings_add_dashboard_widgets' );

/**
 * Widget Contents
 */
function simpleThings_dashboard_widget_function() {
    $simpleThings_widgetText = 'Customize this in the customizer.';
    if (get_theme_mod( 'simpleThings_widget_text') ) {
        $simpleThings_widgetText = get_theme_mod( 'simpleThings_widget_text');
    }
    echo wpautop( $simpleThings_widgetText );
}

/*-----------------------------------------------------------------------------------*/
/* Remove Widgets
/*-----------------------------------------------------------------------------------*/
if( get_theme_mod( 'simpleThings_hide_widgets' ) != '') {
    function remove_dashboard_meta()
    {
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');//since 3.8
    }
    add_action('admin_init', 'remove_dashboard_meta');
}
