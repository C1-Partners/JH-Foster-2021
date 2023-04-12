<?php

function crimson_theme_customizer( $wp_customize ) {

  // //Scripts
  // $wp_customize->add_section(
  //   'crimson_scripts',
  //   array(
  //     'title'     => 'Scripts',
  //     'priority'  => 200
  //   )
  // );

  // //Header Scripts
  // $wp_customize->add_setting(
  //   'crimson_header_scripts',
  //   array(
  //     'default'    =>  '',
  //     'transport'  =>  'refresh'
  //   )
  // );

  // $wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'crimson_header_scripts', array(
  //       'section'   => 'crimson_scripts',
  //       'settings' => 'crimson_header_scripts',
  //       'label'     => 'Custom Header Scripts',
  //       'description' => 'Add any scripts that you\'d like in the <head> section below.',
  //       'code_type' => 'php'
  //     )
  //   )
  // );

  // //Footer Scripts
  // $wp_customize->add_setting(
  //   'crimson_footer_scripts',
  //   array(
  //     'default'    =>  '',
  //     'transport'  =>  'refresh'
  //   )
  // );

  // $wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'crimson_footer_scripts', array(
  //       'section'   => 'crimson_scripts',
  //       'settings' => 'crimson_footer_scripts',
  //       'label'     => 'Custom Footer Scripts',
  //       'description' => 'Add any scripts that you\'d like in the footer section below.',
  //       'code_type' => 'php'
  //     )
  //   )
  // );

  //Site Options
  $wp_customize->add_section(
    'crimson_site_options',
    array(
      'title'     => 'Sitemap & Credits',
      'priority'  => 20
    )
  );

  //Default Page Template
  // $wp_customize->add_setting(
  //   'crimson_default_page_template',
  //   array(
  //     'default'    =>  'crimson-template-no-sidebar.php',
  //     'transport'  =>  'refresh'
  //   )
  // );

  // $templates = wp_get_theme()->get_page_templates();

  // $wp_customize->add_control( 'crimson_default_page_template', array(
  //     'type' => 'select',
  //     'section' => 'crimson_site_options',
  //     'settings' => 'crimson_default_page_template',
  //     'label' => 'Default Page Template',
  //     'description' => 'Choose the default template to be used for all pages',
  //     'choices' => $templates
  //   )
  // );

  //Default Footer Template
  // $wp_customize->add_setting(
  //   'crimson_default_footer_template',
  //   array(
  //     'default'    =>  'b12',
  //     'transport'  =>  'refresh'
  //   )
  // );

  // $wp_customize->add_control( 'crimson_default_footer_template', array(
  //     'type' => 'select',
  //     'section' => 'crimson_site_options',
  //     'settings' => 'crimson_default_footer_template',
  //     'label' => 'Default Footer Template',
  //     'description' => 'Choose the default footer to be used for all pages',
  //     'choices' => array (
  //       'a1-b1' => 'A1-B1',
  //       'a1-b2' => 'A1-B2',
  //       'a1-b12' => 'A1-B12',
  //       'a1-b13' => 'A1-B13',
  //       'a1-b23' => 'A1-B23',
  //       'a1-b123' => 'A1-B123',
  //       'b12' => 'B12'
  //     ),
  //   )
  // );

  //Sitemap Link
  $wp_customize->add_setting(
    'crimson_sitemap_link_on',
    array(
      'default'    =>  'no',
      'transport'  =>  'refresh'
    )
  );

  $wp_customize->add_control( 'crimson_sitemap_link_on', array(
      'type' => 'radio',
      'section' => 'crimson_site_options',
      'settings' => 'crimson_sitemap_link_on',
      'label' => 'Show Sitemap Link?',
      'description' => 'Displays a custom link to the sitemap in the footer',
      'choices' => array(
        'yes' => 'Yes',
        'no' => 'No',
      ),
    )
  );

  function crimson_is_sitemap_link_on() {
    if(get_theme_mod('crimson_sitemap_link_on') == 'yes') {
      return true;
    } else {
      return false;
    }
  }

  $wp_customize->add_setting(
    'crimson_sitemap_link',
    array(
      'default'    =>  '',
      'transport'  =>  'refresh'
    )
  );

  $wp_customize->add_control( 'crimson_sitemap_link', array(
      'type' => 'text',
      'section' => 'crimson_site_options',
      'settings' => 'crimson_sitemap_link',
      'label' => 'Sitemap Link URL',
      'active_callback' => 'crimson_is_sitemap_link_on'
      )
    );

    //Site Credits
    $wp_customize->add_setting(
      'crimson_site_credits_on',
      array(
        'default'    =>  'no',
        'transport'  =>  'refresh'
      )
    );

    $wp_customize->add_control( 'crimson_site_credits_on', array(
        'type' => 'radio',
        'section' => 'crimson_site_options',
        'settings' => 'crimson_site_credits_on',
        'label' => 'Show Site Credits?',
        'description' => 'Displays a logo in the footer for whoever built the site.',
        'choices' => array(
          'yes' => 'Yes',
          'no' => 'No',
        ),
      )
    );

    function crimson_is_site_credits_on() {
      if(get_theme_mod('crimson_site_credits_on') == 'yes') {
        return true;
      } else {
        return false;
      }
    }

    $wp_customize->add_setting(
      'crimson_site_credits_logo',
      array(
        'default'    =>  '',
        'transport'  =>  'refresh'
      )
    );
}

add_action( 'customize_register', 'crimson_theme_customizer' );

?>