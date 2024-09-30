<?php

// Add menu item
function my_slideshow_plugin_menu() {
    add_options_page(
        'Slideshow Settings',
        'Slideshow Settings',
        'manage_options',
        'my-slideshow-plugin',
        'my_slideshow_plugin_settings_page'
    );
}
add_action('admin_menu', 'my_slideshow_plugin_menu');

// Register settings
function my_slideshow_plugin_settings() {
    register_setting('my_slideshow_plugin_settings_group', 'my_slideshow_plugin_images');
}
add_action('admin_init', 'my_slideshow_plugin_settings');

// Enqueue admin scripts
function my_slideshow_plugin_admin_scripts($hook) {
    if ($hook != 'settings_page_my-slideshow-plugin') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('my-slideshow-plugin-admin-scripts', MY_SLIDESHOW_PLUGIN_URL . 'admin/admin-scripts.js', array('jquery'), null, true);
    wp_enqueue_style('my-slideshow-plugin-admin-styles', MY_SLIDESHOW_PLUGIN_URL . 'admin/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'my_slideshow_plugin_admin_scripts');

// Settings page
function my_slideshow_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h1>Slideshow Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('my_slideshow_plugin_settings_group');
            do_settings_sections('my-slideshow-plugin');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Slideshow Images</th>
                    <td>
                        <button type="button" id="my-slideshow-plugin-upload-button" class="button">Add Images</button>
                        <ul id="my-slideshow-plugin-images-list">
                            <?php
                            $image_urls = get_option('my_slideshow_plugin_images', array());
                            if (!empty($image_urls)) {
                                foreach ($image_urls as $image_url) {
                                    echo '<li><img src="' . esc_url($image_url) . '" /><button type="button" class="remove-image-button">Remove</button><input type="hidden" name="my_slideshow_plugin_images[]" value="' . esc_attr($image_url) . '" /></li>';
                                }
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
