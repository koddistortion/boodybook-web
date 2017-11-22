/* ------------------------------------------------------------------------------
*
*  # Fixed secondary sidebar
*
*  Specific JS code additions for layout_navbar_secondary_fixed.html page
*
*  Version: 1.0
*  Latest update: Feb 26, 2016
*
* ---------------------------------------------------------------------------- */

$(function () {

	var $navbarSecond = $('#navbar-second');
	// Affix sidebar
	// ------------------------------

	// When affixed
	$navbarSecond.on('affixed.bs.affix', function () {
		$(this).next().css('margin-top', $(this).outerHeight());
		$('body').addClass('navbar-affixed-top');
	});

	// When on top
	$navbarSecond.on('affixed-top.bs.affix', function () {
		$(this).next().css('margin-top', '');
		$('body').removeClass('navbar-affixed-top');
	});

	// Init
	$navbarSecond.affix({
		offset: {
			top: $navbarSecond.offset().top
		}
	});

});
