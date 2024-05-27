<?php
function mytheme_customize_register($wp_customize) {
    // Yeni bir bölüm ekleyin
    $wp_customize->add_section('atlas_theme_settings', array(
        'title' => __('Logo', 'mytheme'),
        'priority' => 30,
    ));

    // Logo tipini belirlemek için select alanı ekleyin
    $wp_customize->add_setting('custom_logo_type', array(
        'default' => 'text',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    // Logo resmi için dosya yükleme alanı ekleyin
    $wp_customize->add_setting('custom_logo_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    // Logo resmi için dosya yükleme alanı ekleyin
    $wp_customize->add_setting('custom_avatar_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    // Logo metni için alan ekleyin
    $wp_customize->add_setting('custom_logo_text', array(
        'default' => 'John Doe',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    

    $wp_customize->add_control('custom_logo_type_control', array(
        'label' => __('Logo type', 'mytheme'),
        'section' => 'atlas_theme_settings',
        'settings' => 'custom_logo_type',
        'type' => 'select',
        'choices' => array(
            'text' => __('Text', 'mytheme'),
            'image' => __('Image', 'mytheme'),
        ),
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_image_control', array(
        'label' => __('Logo image', 'mytheme'),
        'section' => 'atlas_theme_settings',
        'settings' => 'custom_logo_image',
        'active_callback' => 'is_logo_image',
    )));

    $wp_customize->add_control('custom_text_control', array(
        'label' => __('Logo text', 'mytheme'),
        'section' => 'atlas_theme_settings',
        'settings' => 'custom_logo_text', 
        'type' => 'text',
        'active_callback' => 'is_logo_text',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mytheme_logo_control', array(
        'label'        => __( 'Avatar', 'mytheme' ),
        'section'    => 'atlas_theme_settings',
        'settings'   => 'custom_avatar_image',
    ) ) );


    //About me

    $wp_customize->add_section('atlas_about_settings', array(
        'title' => __('About me', 'mytheme'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('custom_hi_text', array(
        'default' => 'Hi, I’m John Doe.',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_hi_desc', array(
        'default' => 'A software engineer and open-source advocate enjoying the sunny life in Barcelona, Spain.',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_hi_button_text', array(
        'default' => 'Say Hello!',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_hi_button_url', array(
        'default' => 'https://www.berkaygeldec.com.tr/',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_about_title', array(
        'default' => 'My Story',
        'sanitize_callback' => 'sanitize_textarea_content',
    ));   
    $wp_customize->add_setting('custom_about_text', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nibh mauris cursus mattis molestie. Et leo duis ut diam. Sit amet tellus cras adipiscing enim eu turpis. Adipiscing at in tellus integer feugiat.',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_control('custom_hi_text', array(
        'label' => __('Headline text', 'mytheme'),
        'section' => 'atlas_about_settings',
        'settings' => 'custom_hi_text', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_hi_desc', array(
        'label' => __('Headline description', 'mytheme'),
        'section' => 'atlas_about_settings',
        'settings' => 'custom_hi_desc', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_hi_button_text', array(
        'label' => __('Headline button text', 'mytheme'),
        'section' => 'atlas_about_settings',
        'settings' => 'custom_hi_button_text', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_hi_button_url', array(
        'label' => __('Headline button url', 'mytheme'),
        'section' => 'atlas_about_settings',
        'settings' => 'custom_hi_button_url', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_about_title', array(
        'label' => __('About title', 'mytheme'),
        'section' => 'atlas_about_settings',
        'settings' => 'custom_about_title', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_about_text', array(
        'label' => __('About text', 'mytheme'),
        'section' => 'atlas_about_settings',
        'settings' => 'custom_about_text', 
        'type' => 'textarea',
    ));

    $wp_customize->add_section('atlas_post_settings', array(
        'title' => __('Latest posts', 'mytheme'),
        'priority' => 32,
    ));
    $wp_customize->add_setting('custom_post_count', array(
        'default' => '3',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_latest_title', array(
        'default' => 'Latest posts',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_control('custom_latest_title', array(
        'label' => __('Latest post title', 'mytheme'),
        'section' => 'atlas_post_settings',
        'settings' => 'custom_latest_title', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_post_count', array(
        'label' => __('Post count', 'mytheme'),
        'section' => 'atlas_post_settings',
        'settings' => 'custom_post_count', 
        'type' => 'number',
    ));

    $wp_customize->add_section('atlas_copyright_settings', array(
        'title' => __('Copyright', 'mytheme'),
        'priority' => 32,
    ));
    $wp_customize->add_setting('custom_copyright_text', array(
        'default' => '©2024 <a href="https://github.com/berkaygeldec/atlas" target="_blank" title="Atlas is a Personal Blog WordPress theme made with the latest technologies like TailwindCSS.">Atlas</a>.',
        'sanitize_callback' => 'wp_kses_post',
    ));   
    $wp_customize->add_control('custom_copyright_text', array(
        'label' => __('Copyright text', 'mytheme'),
        'section' => 'atlas_copyright_settings',
        'settings' => 'custom_copyright_text', 
        'type' => 'text',
    ));

    $wp_customize->add_section('atlas_social_settings', array(
        'title' => __('Social accounts', 'mytheme'),
        'priority' => 32,
    ));
    $wp_customize->add_setting('custom_github_link', array(
        'default' => 'https://github.com/berkaygeldec',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_codepen_link', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_setting('custom_linkedin_link', array(
        'default' => 'https://www.linkedin.com/in/berkaygeldec/',
        'sanitize_callback' => 'sanitize_text_field',
    ));   
    $wp_customize->add_control('custom_github_link', array(
        'label' => __('Github', 'mytheme'),
        'section' => 'atlas_social_settings',
        'settings' => 'custom_github_link', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_codepen_link', array(
        'label' => __('Codepen', 'mytheme'),
        'section' => 'atlas_social_settings',
        'settings' => 'custom_codepen_link', 
        'type' => 'text',
    ));
    $wp_customize->add_control('custom_linkedin_link', array(
        'label' => __('Linkedin', 'mytheme'),
        'section' => 'atlas_social_settings',
        'settings' => 'custom_linkedin_link', 
        'type' => 'text',
    ));

}
function sanitize_textarea_content($input) {
    // HTML etiketlerini ve yeni satırları koruyarak tüm özel karakterleri dönüştür
    return wp_kses_post($input);
}


// Aktiflik kontrol fonksiyonları
function is_logo_text($control) {
    return $control->manager->get_setting('custom_logo_type')->value() === 'text';
}

function is_logo_image($control) {
    return $control->manager->get_setting('custom_logo_type')->value() === 'image';
}
function mytheme_display_avatar() {
    $logo = get_theme_mod( 'custom_avatar_image' );
    if ( $logo ) {
        echo '<img src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '">';
    } else {
        echo '<h1>' . get_bloginfo( 'name' ) . '</h1>';
    }
}

add_action('customize_register', 'mytheme_customize_register');
?>