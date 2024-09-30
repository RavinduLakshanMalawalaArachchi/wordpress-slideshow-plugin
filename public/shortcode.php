<?php

// Add shortcode
function my_slideshow_plugin_shortcode() {
    $image_urls = get_option('my_slideshow_plugin_images', array());

    if (empty($image_urls)) {
        return 'No images found for the slideshow.';
    }

    ob_start();
    ?>
    <div class="my-slideshow">
        <?php foreach ($image_urls as $image_url) : ?>
            <div class="slide">
                <img src="<?php echo esc_url(trim($image_url)); ?>" alt="Slideshow Image">
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('my_slideshow', 'my_slideshow_plugin_shortcode');
