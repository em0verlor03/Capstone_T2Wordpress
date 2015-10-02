/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function() {
var clicked = null;

jQuery('.upload_image_button').click(function() {
 clicked = jQuery(this);
 formfield = jQuery(this).prev('input').attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 clicked.prev('input').val(imgurl);
 tb_remove();
};
});

