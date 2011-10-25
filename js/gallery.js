
$(document).ready(function() {
	$('.PanelActions li').hide();
	$('#ToggleActions').addClass('Collapsed');
	// Toggles Categories
	// Toggles Actions
	$('#ToggleActions').live('click', function() {
		$(this).toggleClass('Collapsed');
		$('.PanelActions li').toggle();
	});
	// toggle variable for navigation menus.
	$('h2.Format').click( function() {
		$(this).next('ul').toggle('fast');
	});

/*--------------------------------- Functions -----------------------------------*/


	$("li.Image").hover(function() {
		$(this).css({'z-index' : '10'}); /*Add a higher z-index value so this image stays on top*/
		$(this).find('img').addClass("hover").stop() /* Add class of "hover", then stop animation queue buildup*/
		.animate({
			width: '150px', /* Set new width */
			height: '150px' /* Set new height */
		}, 200); /* this value of "200" is the speed of how fast/slow this hover animates */

	} , function() {
	$(this).css({'z-index' : '0'}); /* Set z-index back to 0 */
	$(this).find('img').removeClass("hover").stop()  /* Remove the "hover" class , then stop animation queue buildup*/
		.animate({
			top: '0',
			left: '0',
			width: '120px', /* Set width back to default */
			height: '120px' /* Set height back to default */
		}, 400);
	});
	$('#Choices a.ItemPage').each(function(index) {
		imgSrc = $(this).find('img.Gallery').attr('src');
		$(this).attr('href', imgSrc);
	});
	$('#Choices a.ItemPage').lightBox({
		fixedNavigation:true,
		imageLoading:"/applications/galleries/design/images/lightbox-ico-loading.gif",
		imageBtnClose:"/applications/galleries/design/images/lightbox-btn-close.gif",
		imageBtnPrev:"/applications/galleries/design/images/lightbox-btn-prev.gif",
		imageBtnNext:"/applications/galleries/design/images/lightbox-btn-next.gif",
		imageBlank:"/applications/galleries/design/images/lightbox-blank.gif"

	});

});


