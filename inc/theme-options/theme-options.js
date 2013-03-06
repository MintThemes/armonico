/**
 * Theme options media upload
 *
 * @since Armonico 1.0
 */
jQuery(document).ready(function() {
 
jQuery('#upload_image_button').click(function() {
uploadid = jQuery(this).prevAll("input[type=text]");
formfield = jQuery(uploadid).attr('name');
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
 
window.send_to_editor = function(html) {
imgurl = jQuery('img',html).attr('src');
jQuery(uploadid).val(imgurl);
tb_remove();
}
 
});

/**
 * Widgets media upload
 *
 * @since Armonico 1.0
 */
jQuery(document).ready(function($) {
  $(document).on("click", "#upload_image_button", function() { 
	uploadid = jQuery(this).prevAll("input[type=text]");
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		$(uploadid).val(imgurl);
		tb_remove();
	};

	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
  });
});

/**
 * Theme options color picker
 *
 * @since Armonico 1.0
 */
jQuery(document).ready(function($) {
   $('.pickcolor').click( function(e) {
		colorPicker = jQuery(this).next('div');
		input = jQuery(this).prev('input');
		$(colorPicker).farbtastic(input);
		colorPicker.show();
		e.preventDefault();
		$(document).mousedown( function() {
			$(colorPicker).hide();
		});
	});
});