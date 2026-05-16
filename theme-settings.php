<?php

/**
 * Register Settings 
 * 
 * settings menu page: wp-admin > settings > global settings.
 * 
 * register_setting('your_theme_group_name', 'key_to_save_in_DB_PREFIX_options', 'sanitize_callback');
 */
function wp_theme_register_settings() {

    // Header
    register_setting('wp_theme_header_group', 'header_site_image', 'esc_url_raw');
    register_setting('wp_theme_header_group', 'header_cta_title', 'sanitize_text_field');
    register_setting('wp_theme_header_group', 'header_cta_url', 'esc_url_raw');

    // Footer
    register_setting('wp_theme_footer_group', 'footer_site_image', 'esc_url_raw');
    register_setting('wp_theme_footer_group', 'footer_short_description', 'sanitize_textarea_field');
    register_setting('wp_theme_footer_group', 'footer_menu_title', 'sanitize_text_field');
    register_setting('wp_theme_footer_group', 'footer_copyright_text', 'sanitize_text_field');

    // Social
    register_setting('wp_theme_social_group', 'social_facebook', 'esc_url_raw');
    register_setting('wp_theme_social_group', 'social_instagram', 'esc_url_raw');
    register_setting('wp_theme_social_group', 'social_twitter', 'esc_url_raw');
    register_setting('wp_theme_social_group', 'social_youtube', 'esc_url_raw');
    register_setting('wp_theme_social_group', 'social_linkedin', 'esc_url_raw');
    register_setting('wp_theme_social_group', 'social_whatsapp', 'sanitize_text_field');

    // Contact
    register_setting('wp_theme_contact_group', 'contact_phone', 'sanitize_text_field');
    register_setting('wp_theme_contact_group', 'contact_email', 'sanitize_email');
    register_setting('wp_theme_contact_group', 'contact_address', 'sanitize_textarea_field');
}
add_action('admin_init', 'wp_theme_register_settings');


/* Options Page */
// function wp_theme_add_options_page() {
//     add_options_page(
//         'Global Settings',
//         'Global Settings',
//         'manage_options',
//         'global-settings',
//         'wp_theme_settings_page'
//     );
// }
// add_action('admin_menu', 'wp_theme_add_options_page');
/* Options Page */
function wp_theme_add_options_page() {
    add_menu_page(
        'Global Settings',        // Page title
        'Global Settings',        // Menu title
        'manage_options',         // Capability
        'global-settings',        // Menu slug
        'wp_theme_settings_page', // Callback function
        'dashicons-palmtree',     // Icon (dashicons-palmtree)
        30                        // Position (adjust as needed)
    );
}
add_action('admin_menu', 'wp_theme_add_options_page');


/* Enqueue Media Uploader Scripts */
function wp_theme_enqueue_media_uploader($hook) {
    if ('settings_page_global-settings' !== $hook) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    
    // Add custom JavaScript for media uploader with jQuery dependency
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            // Function to handle media upload for any button
            function setupMediaUploader(buttonId, inputId, previewId) {
                // Upload button click
                $("body").on("click", buttonId, function(e) {
                    e.preventDefault();
                    
                    var customUploader = wp.media({
                        title: "Select or Upload Image",
                        library: {
                            type: "image"
                        },
                        button: {
                            text: "Use this image"
                        },
                        multiple: false
                    });
                    
                    customUploader.on("select", function() {
                        var attachment = customUploader.state().get("selection").first().toJSON();
                        
                        // Store the full image URL
                        var imageUrl = attachment.url;
                        
                        // If you want a specific size, you can use:
                        // var imageUrl = attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
                        
                        $(inputId).val(imageUrl);
                        
                        // Show preview
                        $(previewId).html(\'<img src="\' + imageUrl + \'" style="max-width: 200px; max-height: 200px; margin-top: 10px; border: 1px solid #ddd; padding: 5px; background: #f9f9f9;">\');
                        
                        // Show remove button
                        $(buttonId + "-remove").show();
                    });
                    
                    customUploader.open();
                });
                
                // Remove image
                $("body").on("click", buttonId + "-remove", function(e) {
                    e.preventDefault();
                    $(inputId).val("");
                    $(previewId).empty();
                    $(this).hide();
                });
            }
            
            // Setup uploaders for header and footer images
            setupMediaUploader("#upload_header_image", "#header_site_image", "#header_image_preview");
            setupMediaUploader("#upload_footer_image", "#footer_site_image", "#footer_image_preview");
        });
    ');
    
    // Add CSS
    wp_add_inline_style('wp-admin', '
        .image-preview {
            margin-top: 15px;
            margin-bottom: 10px;
        }
        .image-preview img {
            max-width: 200px;
            max-height: 200px;
            border: 1px solid #ddd;
            padding: 5px;
            background: #f9f9f9;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .remove-image {
            margin-left: 10px;
            color: #a00;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .remove-image:hover {
            color: #dc3232;
            text-decoration: underline;
        }
        .upload-button {
            margin-right: 5px;
        }
        .image-url-field {
            margin-top: 10px;
            width: 100%;
        }
        .image-url-field input {
            width: 100%;
            max-width: 500px;
        }
    ');
}
add_action('admin_enqueue_scripts', 'wp_theme_enqueue_media_uploader');

/* Page Callback */
function wp_theme_settings_page() {
    $tab = isset($_GET['tab']) ? $_GET['tab'] : 'header';
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
                settings_fields('wp_theme_header_group'); 
                $header_image = get_option('header_site_image');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Header Image</th>
                        <td>
                            <div class="upload-container">
                                <button type="button" class="button button-primary upload-button" id="upload_header_image">
                                    <span class="dashicons dashicons-upload" style="vertical-align: middle;"></span> Select or Upload Image
                                </button>
                                <button type="button" class="button remove-image" id="upload_header_image-remove" <?php echo empty($header_image) ? 'style="display:none;"' : ''; ?>>
                                    <span class="dashicons dashicons-trash" style="vertical-align: middle;"></span> Remove Image
                                </button>
                                
                                <div class="image-url-field">
                                    <label>Image URL:</label>
                                    <input type="url" class="regular-text" name="header_site_image" id="header_site_image" value="<?php echo esc_url($header_image); ?>" readonly>
                                    <p class="description">URL is automatically filled when you upload an image</p>
                                </div>
                                
                                <div class="image-preview" id="header_image_preview">
                                    <?php if (!empty($header_image)): ?>
                                        <img src="<?php echo esc_url($header_image); ?>" alt="Header Image Preview">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">CTA Button Title</th>
                        <td><input type="text" class="regular-text" name="header_cta_title" value="<?php echo esc_attr(get_option('header_cta_title')); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row">CTA Button URL</th>
                        <td><input type="url" class="regular-text" name="header_cta_url" value="<?php echo esc_attr(get_option('header_cta_url')); ?>"></td>
                    </tr>
                </table>
            <?php }

            if ($tab === 'footer') {
                settings_fields('wp_theme_footer_group'); 
                $footer_image = get_option('footer_site_image');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Footer Image</th>
                        <td>
                            <div class="upload-container">
                                <button type="button" class="button button-primary upload-button" id="upload_footer_image">
                                    <span class="dashicons dashicons-upload" style="vertical-align: middle;"></span> Select or Upload Image
                                </button>
                                <button type="button" class="button remove-image" id="upload_footer_image-remove" <?php echo empty($footer_image) ? 'style="display:none;"' : ''; ?>>
                                    <span class="dashicons dashicons-trash" style="vertical-align: middle;"></span> Remove Image
                                </button>
                                
                                <div class="image-url-field">
                                    <label>Image URL:</label>
                                    <input type="url" class="regular-text" name="footer_site_image" id="footer_site_image" value="<?php echo esc_url($footer_image); ?>" readonly>
                                    <p class="description">URL is automatically filled when you upload an image</p>
                                </div>
                                
                                <div class="image-preview" id="footer_image_preview">
                                    <?php if (!empty($footer_image)): ?>
                                        <img src="<?php echo esc_url($footer_image); ?>" alt="Footer Image Preview">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Short Description</th>
                        <td><textarea class="large-text" rows="3" name="footer_short_description"><?php echo esc_textarea(get_option('footer_short_description')); ?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">Footer Menu Title</th>
                        <td><input type="text" class="regular-text" name="footer_menu_title" value="<?php echo esc_attr(get_option('footer_menu_title')); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row">Copyright Text</th>
                        <td><input type="text" class="regular-text" name="footer_copyright_text" value="<?php echo esc_attr(get_option('footer_copyright_text')); ?>"></td>
                    </tr>
                </table>
            <?php }

            if ($tab === 'social') {
                settings_fields('wp_theme_social_group'); ?>
                <table class="form-table">
                    <?php
                    $socials = [
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'twitter' => 'Twitter/X',
                        'youtube' => 'YouTube',
                        'linkedin' => 'LinkedIn'
                    ];
                    foreach ($socials as $key => $label) { ?>
                        <tr>
                            <th scope="row"><?php echo $label; ?> URL</th>
                            <td><input type="url" class="regular-text" name="social_<?php echo $key; ?>" value="<?php echo esc_attr(get_option("social_$key")); ?>" placeholder="https://"></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th scope="row">WhatsApp Number</th>
                        <td><input type="text" class="regular-text" name="social_whatsapp" value="<?php echo esc_attr(get_option('social_whatsapp')); ?>" placeholder="+1234567890"></td>
                    </tr>
                </table>
            <?php }

            if ($tab === 'contact') {
                settings_fields('wp_theme_contact_group'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td><input type="text" class="regular-text" name="contact_phone" value="<?php echo esc_attr(get_option('contact_phone')); ?>" placeholder="+1234567890"></td>
                    </tr>
                    <tr>
                        <th scope="row">Email Address</th>
                        <td><input type="email" class="regular-text" name="contact_email" value="<?php echo esc_attr(get_option('contact_email')); ?>" placeholder="info@example.com"></td>
                    </tr>
                    <tr>
                        <th scope="row">Contact Address</th>
                        <td><textarea class="large-text" rows="3" name="contact_address" placeholder="Enter your address here..."><?php echo esc_textarea(get_option('contact_address')); ?></textarea></td>
                    </tr>
                </table>
            <?php }

            submit_button('Save Settings');
            ?>
        </form>
    </div>
<?php }