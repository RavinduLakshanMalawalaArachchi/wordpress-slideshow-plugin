jQuery(document).ready(function($) {
    var file_frame;
    
    $('#my-slideshow-plugin-upload-button').on('click', function(event) {
        event.preventDefault();

        if (file_frame) {
            file_frame.open();
            return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select Images',
            button: {
                text: 'Add to slideshow'
            },
            multiple: true
        });

        file_frame.on('select', function() {
            var selection = file_frame.state().get('selection');
            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                $('#my-slideshow-plugin-images-list').append(
                    '<li><img src="' + attachment.url + '" /><button type="button" class="remove-image-button">Remove</button><input type="hidden" name="my_slideshow_plugin_images[]" value="' + attachment.url + '" /></li>'
                );
            });
        });

        file_frame.open();
    });

    $('body').on('click', '.remove-image-button', function() {
        $(this).closest('li').remove();
    });
});
