<?php

/* Register Settings */
function mc_wp_theme_register_settings() {

    // Header
    register_setting('mc_wp_theme_header_group', 'mc_header_site_image', 'esc_url_raw');
    register_setting('mc_wp_theme_header_group', 'mc_header_cta_title', 'sanitize_text_field');
    register_setting('mc_wp_theme_header_group', 'mc_header_cta_url', 'esc_url_raw');

    // Footer
    register_setting('mc_wp_theme_footer_group', 'mc_footer_site_image', 'esc_url_raw');
    register_setting('mc_wp_theme_footer_group', 'mc_footer_short_description', 'sanitize_textarea_field');
    register_setting('mc_wp_theme_footer_group', 'mc_footer_menu_title', 'sanitize_text_field');
    register_setting('mc_wp_theme_footer_group', 'mc_footer_copyright_text', 'sanitize_text_field');

    // Social
    register_setting('mc_wp_theme_social_group', 'mc_social_facebook', 'esc_url_raw');
    register_setting('mc_wp_theme_social_group', 'mc_social_instagram', 'esc_url_raw');
    register_setting('mc_wp_theme_social_group', 'mc_social_twitter', 'esc_url_raw');
    register_setting('mc_wp_theme_social_group', 'mc_social_youtube', 'esc_url_raw');
    register_setting('mc_wp_theme_social_group', 'mc_social_linkedin', 'esc_url_raw');
    register_setting('mc_wp_theme_social_group', 'mc_social_whatsapp', 'sanitize_text_field');

    // Contact
    register_setting('mc_wp_theme_contact_group', 'mc_contact_phone', 'sanitize_text_field');
    register_setting('mc_wp_theme_contact_group', 'mc_contact_email', 'sanitize_email');
    register_setting('mc_wp_theme_contact_group', 'mc_contact_address', 'sanitize_textarea_field');
}
add_action('admin_init', 'mc_wp_theme_register_settings');


/* Options Page */
function mc_wp_theme_add_options_page() {
    add_options_page(
        'Global Settings',
        'Global Settings',
        'manage_options',
        'global-settings',
        'mc_wp_theme_settings_page'
    );
}
add_action('admin_menu', 'mc_wp_theme_add_options_page');


/* Page Callback */
function mc_wp_theme_settings_page() {
    $tab = $_GET['tab'] ?? 'header';
    ?>
    <div class="wrap">
        <h1>Global Theme Settings</h1>

        <h2 class="nav-tab-wrapper">
            <a href="?page=global-settings&tab=header" class="nav-tab <?php echo $tab=='header'?'nav-tab-active':''; ?>">Header</a>
            <a href="?page=global-settings&tab=footer" class="nav-tab <?php echo $tab=='footer'?'nav-tab-active':''; ?>">Footer</a>
            <a href="?page=global-settings&tab=social" class="nav-tab <?php echo $tab=='social'?'nav-tab-active':''; ?>">Social Medias</a>
            <a href="?page=global-settings&tab=contact" class="nav-tab <?php echo $tab=='contact'?'nav-tab-active':''; ?>">Contact Areas</a>
        </h2>

        <form method="post" action="options.php">
            <?php

            if ($tab === 'header') {
                settings_fields('mc_wp_theme_header_group'); ?>
                <table class="form-table">
                    <tr>
                        <th>Header Image URL</th>
                        <td><input type="url" class="regular-text" name="mc_header_site_image" value="<?php echo esc_attr(get_option('mc_header_site_image')); ?>"></td>
                    </tr>
                    <tr>
                        <th>CTA Button Title</th>
                        <td><input type="text" class="regular-text" name="mc_header_cta_title" value="<?php echo esc_attr(get_option('mc_header_cta_title')); ?>"></td>
                    </tr>
                    <tr>
                        <th>CTA Button URL</th>
                        <td><input type="url" class="regular-text" name="mc_header_cta_url" value="<?php echo esc_attr(get_option('mc_header_cta_url')); ?>"></td>
                    </tr>
                </table>
            <?php }

            if ($tab === 'footer') {
                settings_fields('mc_wp_theme_footer_group'); ?>
                <table class="form-table">
                    <tr>
                        <th>Footer Image URL</th>
                        <td><input type="url" class="regular-text" name="mc_footer_site_image" value="<?php echo esc_attr(get_option('mc_footer_site_image')); ?>"></td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td><textarea class="large-text" rows="3" name="mc_footer_short_description"><?php echo esc_textarea(get_option('mc_footer_short_description')); ?></textarea></td>
                    </tr>
                    <tr>
                        <th>Footer Menu Title</th>
                        <td><input type="text" class="regular-text" name="mc_footer_menu_title" value="<?php echo esc_attr(get_option('mc_footer_menu_title')); ?>"></td>
                    </tr>
                    <tr>
                        <th>Copyright Text</th>
                        <td><input type="text" class="regular-text" name="mc_footer_copyright_text" value="<?php echo esc_attr(get_option('mc_footer_copyright_text')); ?>"></td>
                    </tr>
                </table>
            <?php }

            if ($tab === 'social') {
                settings_fields('mc_wp_theme_social_group'); ?>
                <table class="form-table">
                    <?php
                    $socials = [
                        'facebook','instagram','twitter','youtube','linkedin'
                    ];
                    foreach ($socials as $s) { ?>
                        <tr>
                            <th><?php echo ucfirst($s); ?> URL</th>
                            <td><input type="url" class="regular-text" name="mc_social_<?php echo $s; ?>" value="<?php echo esc_attr(get_option("mc_social_$s")); ?>"></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>WhatsApp Number</th>
                        <td><input type="text" class="regular-text" name="mc_social_whatsapp" value="<?php echo esc_attr(get_option('mc_social_whatsapp')); ?>"></td>
                    </tr>
                </table>
            <?php }

            if ($tab === 'contact') {
                settings_fields('mc_wp_theme_contact_group'); ?>
                <table class="form-table">
                    <tr>
                        <th>Phone Number</th>
                        <td><input type="text" class="regular-text" name="mc_contact_phone" value="<?php echo esc_attr(get_option('mc_contact_phone')); ?>"></td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td><input type="email" class="regular-text" name="mc_contact_email" value="<?php echo esc_attr(get_option('mc_contact_email')); ?>"></td>
                    </tr>
                    <tr>
                        <th>Contact Address</th>
                        <td><textarea class="large-text" rows="3" name="mc_contact_address"><?php echo esc_textarea(get_option('mc_contact_address')); ?></textarea></td>
                    </tr>
                </table>
            <?php }

            submit_button();
            ?>
        </form>
    </div>
<?php }
