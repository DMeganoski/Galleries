/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
	$('ol.Categories').hide();
	$('table.GalleryClass').click(function() {
		$(this).next('ol').toggle('fast');
	});
});

