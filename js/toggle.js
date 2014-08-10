
/* ----------------------------------------------------------------------------------------------------

CSSGrid is a Responsive CSS Grid designed to work on web and mobile devices. (www.cssgrid.co)
Please don't steal. Support this grid and buy a license from: http://codecanyon.net/item/responsive-html5-css-grid/4928861?ref=human1nt

---------------------------------------------------------------------------------------------------- */

// Change .navclosed to navclicked + change .wrapper to wrapper-push
$(".navclosed").click(function () {
	$(this).toggleClass("navclicked");
	$(".wrapper").toggleClass("wrapper-push");
	toggleMenu();
	//checkState();
});


