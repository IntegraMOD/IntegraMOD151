jQuery.noConflict();
jQuery(document).ready(function(){
		jQuery(function() {
		
			jQuery('nav.mobile-menu').mobTabMenu({
			
				position: 				'default',
				speed:    				500,
				hideMenuOnResize:       900,
				toggleElements:			'.toggle',
				openElements:			'.open',
				closeElements:			'.close',
				onInit:					function() { console.log('mobTabMenu onInit'); },
				onOpened:				function() { console.log('mobTabMenu onOpened'); },
				onClosed:				function() { console.log('mobTabMenu onClosed'); },
				onToggled:				function() { console.log('mobTabMenu onToggled'); },
				onBeforeOpen:			function() { console.log('mobTabMenu onBeforeOpen'); },
				onBeforeClose:			function() { console.log('mobTabMenu onBeforeClose'); },
				onBeforeToggle:			function() { console.log('mobTabMenu onBeforeToggle'); }
			
			});
		
		});
	});