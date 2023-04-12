<?php

// Set specific color support for WP editor
add_theme_support(
    'editor-color-palette',
    array(
        array(
            'name'  => esc_html__( 'Black', 'sensorsinc' ),
            'slug'  => 'black',
            'color' => '#000',
        ),
        array(
            'name'  => esc_html__( 'White', 'sensorsinc' ),
            'slug'  => 'white',
            'color' => '#fff',
        ),
        array(
            'name'  => esc_html__( 'Primary', 'sensorsinc' ),
            'slug'  => 'primary',
            'color' => '--color-primary',
        ),
         
    )
);