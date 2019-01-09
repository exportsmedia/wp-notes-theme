<?php
/*
*
*	Add options to customizer
*
*/

function theme_customizer_options() {

    global $wp_customize;

    $wp_customize->add_section(
        'featured_category_section',
        array(
            'title'     	=> 'Featured Category',
            'priority'  	=> 30,
            'description'	=> "This category will be used to feature on the front page."
        )
    );

    $wp_customize->add_setting( 'featured_category', array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ) );

        $wp_customize->add_control( new Theme_Category_Control( $wp_customize, 'featured_category', array(
            'section'       => 'featured_category_section',
            'label'         => "Choose Category to Feature",
            'description'   => "",
        ) ) );

}


add_action( 'customize_register', 'theme_customizer_options' );

