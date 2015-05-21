<?php
/**
 * Custom Login
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function simpleThings_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'simpleThings_section',
        array(
            'title' => 'Custom Login',
            'description' => 'Customize the logo on the login screen.',
            'priority' => 35,
        )
    );

    $wp_customize->add_setting( 'simpleThings-logo-upload' );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'simpleThings-logo-upload',
            array(
                'label' => 'Login Screen Logo',
                'section' => 'simpleThings_section',
                'settings' => 'simpleThings-logo-upload'
            )
        )
    );
}
add_action( 'customize_register', 'simpleThings_customizer' );

/** Display Logo */
function simpleThings_login_logo() {
    if ( get_theme_mod( 'simpleThings-logo-upload') ) { ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo get_theme_mod( 'simpleThings-logo-upload', 'http://placehold.it/100x100' ); ?>);
                padding-bottom: 0px;
                margin-bottom: 0px;
                background-size: 100px;
                height: 100px;
                width: auto;
            }
        </style>
    <?php } ?>
<?php }
add_action( 'login_enqueue_scripts', 'simpleThings_login_logo' );

function simpleThings_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'simpleThings_login_logo_url' );
function simpleThings_login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'simpleThings_login_logo_url_title' );