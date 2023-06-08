jQuery.noConflict();
jQuery(document).ready(function(){
 	// hides the fastreply as soon as the DOM is ready
 	// (a little sooner than page load)
  	jQuery('.fastreply').hide();
 	// toggles the fastreply on clicking the link
  	jQuery('a.fast-reply').click(function() {
 		jQuery('.fastreply').toggle(500);
 		return false;
  		});
	});

	jQuery.noConflict();
	jQuery(document).ready(function(){
		jQuery("a.button").click(function(){
		jQuery(this).toggleClass("active").next().slideToggle();
		});

	});