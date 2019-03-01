/*!
 *
 * jQuery mobTabMenu
 *
 * A jQuery mobile and tablet menu plugin
 *
 * @author 		Tim Bennett
 * @version 	1.0.0
 * @license		www.texelate.co.uk/mit-license/
 *
 * Download the latest version at www.texelate.co.uk/lab/project/mob-tab-menu/
 *
 * Copyright (c) 2015 Texelate Ltd, www.texelate.co.uk
 *
 */
 
 
 
;(function($){

	$.fn.mobTabMenu = function(options) {  
	
		/**
		 * Defaults
		 */
		var defaults = { 

			fixedElements:				null,							// Elements that need animating separately (fixed positioned elements)
			invertedFixedElements:      null,							// Same as above but the animated property is inverted (e.g. if the position property is set to 'top', 'bottom' will be animated)
			hideMenuOnResize:			false,							// If set to an int, the menu will hide when the browser width exceeds this value
			toggleElements:				'.mob-tab-menu-toggle',			// Elements that trigger the open/close of the menu (usually anchor tags)
			openElements:				'.mob-tab-menu-open',			// Links that trigger the open of the menu
			closeElements:				'.mob-tab-menu-close',			// Links that trigger the close of the menu
			toggleEvent:				'click',						// Toggle event
			activeClass:				'mob-tab-menu-active',			// Class added to trigger elements when menu is open
			speed:						0, 								// Animation speed, 0 for toggle
			position: 					'left',							// The position of the menu: 'default' | 'left' | 'top' | 'right'; leave the element where it is
			animateBody: 				false,							// Whether to animate the page content along with the menu: true | false; doesn't apply to position 'default'
			easing:						'',								// Easing
			preventFOUC:				true,							// Prevent FOUC (Flash Of Unwanted Content); requires you add style="display: none;" to your menu
			onInit:						function() {},					// Callback on initialised
			onOpened:					function() {},					// Callback on menu opened
			onClosed:					function() {},					// Callback on menu closed
			onToggled:					function() {},					// Callback on menu opened/closed
			onBeforeOpen:				function() {},					// Callback on before menu opened
			onBeforeClose:				function() {},					// Callback on before menu closed
			onBeforeToggle:				function() {},					// Callback on before menu opened/closed
		
		};
		
		
		/**
		 * Options
		 */
		var options 					= $.extend(defaults, options);	// Options
		var objArray					= this;							// Array of objects
		var isOpen						= false;						// Flag for whether it's open or not
		var isAnimating					= false;						// Flag to check if it's animating
		var menuSize					= null;							// Menu size in px
		var hasAddedFirst				= false;						// Flag to ensure only once instance is created
		var $window						= $(window);					// Window


		return this.each(function() {
		
			/**
			 * Singleton
			 */
			if(hasAddedFirst === true) {
			
				return;
			
			}
			else {
			
				hasAddedFirst = true;
			
			}
			
			/**
			 * Cache selectors
			 */
			var $this 				= $(this);
			var $toggleElements		= $(options.toggleElements);
			var $pseudoBody			= null;
			
			
			/**
			 * Fixed elements
			 */
			if(options.fixedElements !== null) {
			
				var $fixedElements = $(options.fixedElements);
			
			}
			else {
			
				var $fixedElements = null;
			
			}
			
			
			/**
			 * Inverted fixed elements
			 */
			if(options.invertedFixedElements !== null) {
			
				var $invertedFixedElements = $(options.invertedFixedElements);
			
			}
			else {
			
				var $invertedFixedElements = null;
			
			}
			
			
			/**
			 * Set up menu
			 */
			if(options.position != 'default') {
					
				// Add the core CSS
				$this.addClass('mob-tab-menu-position-fixed');
				
				// Add vert/horiz class
				if(options.position == 'top') {
				
					$this.addClass('mob-tab-menu-position-fixed-vert');
					$this.addClass('mob-tab-menu-position-fixed-top');
				
				}
				else if(options.position == 'left') {
				
					$this.addClass('mob-tab-menu-position-fixed-horiz');
					$this.addClass('mob-tab-menu-position-fixed-left');
				
				}
				else {
				
					$this.addClass('mob-tab-menu-position-fixed-horiz');
					$this.addClass('mob-tab-menu-position-fixed-right');
				
				}
				
				if(options.position == 'top') {
				
					menuSize = $this.outerHeight();
					
				}
				else {
				
					menuSize = $this.outerWidth();
				
				}
				
				if(options.animateBody === true) {
				
					// If animating the body, wrap everything in a div and cache the body tag
					$('body').wrapInner('<div id="mob-tab-menu-pseudo-body"></div>');
					
					// Cache pseudo body
					$pseudoBody = $('div#mob-tab-menu-pseudo-body');
				
				}
				
				// Add the body and non static elements so they can all be animated together
				if($pseudoBody !== null) {
				
					if($fixedElements === null) {
					
						$fixedElements = $pseudoBody;
					
					}
					else {
					
						$fixedElements = $fixedElements.add($pseudoBody);
					
					}
				
				}
				// Create JSON
				var json = '{"' + options.position + '" : "-' + menuSize + 'px' + '"}';
				
				// Set initial position
				$this.css($.parseJSON(json));
							
			}
			else {
			
				// Hide the menu
				$this.hide();
			
			}
			
			
			/**
			 * Add the trigger event
			 */
			$toggleElements.on(options.toggleEvent, function(e) {;
			
				e.preventDefault();
				
				if(isOpen === true) {
				
					close($this, $fixedElements, $invertedFixedElements, $toggleElements);
				
				}
				else {
				
					open($this, $fixedElements, $invertedFixedElements, $toggleElements);
				
				}
			
			});
			
			
			/*
			 * Open links
			 */
			$(options.openElements).on('click', function(e) {
			
				e.preventDefault();
				
				open($this, $fixedElements, $invertedFixedElements, $toggleElements);
			
			});
			
			
			/**
			 * Close links
			 */
			$(options.closeElements).on('click', function(e) {
			
				e.preventDefault();
				
				close($this, $fixedElements, $invertedFixedElements, $toggleElements);
			
			});
			
			
			/*
			 * Resize handler to hide the bar
			 */
			if(options.hideMenuOnResize !== false) {
			
				$window.resize(function() {

					if(isOpen === true) {
					
						// Get the viewport width
						var viewportWidth 	= $window.width();
						
						// Show/hide body and menu
						if(viewportWidth >= options.hideMenuOnResize) {
						
							$this.hide();
							
							if(options.position != 'default') {
							
								$pseudoBody.css(options.position, '0px');
								
							}
						
						}
						else {
						
							$this.show();
							
							if(options.position != 'default') {
							
								$pseudoBody.css(options.position, $this.outerWidth() + 'px');
								
							}
						
						}
					
					}
				  
				});
			
			}

			
			/**
			 * Public function to open the menu
			 */
			$.fn.open = function() {
			
				open($(this), $fixedElements, $invertedFixedElements, $toggleElements);
			
			}
			
			
			/**
			 * Public function to close the menu
			 */
			$.fn.close = function() {
			
				close($(this), $fixedElements, $invertedFixedElements, $toggleElements);
			
			}
			
			
			/**
			 * Public function to toggle the menu
			 */
			$.fn.toggle = function() {
			
				if(isOpen === true) {
				
					close($(this), $fixedElements, $invertedFixedElements, $toggleElements);
				
				}
				else {
				
					open($(this), $fixedElements, $invertedFixedElements, $toggleElements);
				
				}
			
			}
			
			
			/**
			 * Opens the menu
			 */
			function open($menu, $fixedElements, $invertedFixedElements, $toggleElements) {

				if(isOpen === false && isAnimating === false) {
				
					// onBeforeOpen callback
					options.onBeforeOpen.call(this);
					
					// onBeforeToggle callback
					options.onBeforeToggle.call(this);
				
					if(options.position == 'default') {
					
						// Add active class
						$toggleElements.addClass(options.activeClass);
					
						// Animation flag
						isAnimating = true;
						
						$menu.slideDown(options.speed, options.easing, function() {
						
							// onOpened callback
							options.onOpened.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
							
							// Animation flag
							isAnimating = false;
							
							// Open flag
							isOpen = true;
							
							// onOpened callback
							options.onOpened.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
						
						});
					
					}
					else {
					
						// Remove active class
						$toggleElements.addClass(options.activeClass);

						// Animation flag
						isAnimating = true;
						
						// Direction
						var direction = '+=';
						
						// Fixed elements
						if($fixedElements !== null) {
						
							// Create JSON
							var json = '{"' + options.position + '" : "' + direction + menuSize + 'px' + '"}';
							
							// Animate other elements
							$fixedElements.animate($.parseJSON(json), options.speed, options.easing);
						
						}
						
						// Inverted fixed elements
						if($invertedFixedElements !== null) {
						
							if(options.position == 'right') {
							
								var invertedPosition = 'left';
								
							}
							else if(options.position == 'left') {
							
								var invertedPosition = 'right';
							
							}
							else if(options.position == 'top') {
							
								var invertedPosition = 'bottom';
							
							}
							else {
							
								var invertedPosition = 'top';
							
							}
						
							// Create JSON
							var json = '{"' + invertedPosition + '" : "-=' + menuSize + 'px' + '"}';
							
							// Animate inverted elements
							$invertedFixedElements.animate($.parseJSON(json), options.speed, options.easing);
						
						}
						
						// Create JSON
						var json = '{"' + options.position + '" : "' + direction + menuSize + 'px' + '"}';
						
						// Animate menu
						$menu.animate($.parseJSON(json), options.speed, options.easing, function() {
						
							// onOpened callback
							options.onOpened.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
							
							// Animation flag
							isAnimating = false;
							
							// Open flag
							isOpen = true;
							
							// onOpened callback
							options.onOpened.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
						
						});
					
					}
				
				}
			
			}
			
			
			/**
			 * Closes the menu
			 */
			function close($menu, $fixedElements, $invertedFixedElements, $toggleElements) {
			
				// onBeforeClose callback
				options.onBeforeClose.call(this);
				
				// onBeforeToggle callback
				options.onBeforeToggle.call(this);
			
				if(isOpen === true && isAnimating === false) {
				
					if(options.position == 'default') {
					
						// Add active class
						$toggleElements.removeClass(options.activeClass);
					
						// Animation flag
						isAnimating = true;
						
						// Animate menu
						$menu.slideUp(options.speed, options.easing, function() {
						
							// onClosed callback
							options.onClosed.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
							
							// Animation flag
							isAnimating = false;
							
							// Open flag
							isOpen = false;
							
							// onClosed callback
							options.onClosed.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
						
						});
					
					}
					else {
					
						// Remove active class
						$toggleElements.removeClass(options.activeClass);
						
						// Animation flag
						isAnimating = true;
						
						// Direction
						var direction = '-=';
						
						// Fixed elements
						if($fixedElements !== null) {
						
							// Create JSON
							var json = '{"' + options.position + '" : "' + direction + menuSize + 'px' + '"}';
							
							// Animate other elements
							$fixedElements.animate($.parseJSON(json), options.speed, options.easing);
						
						}
						
						// Inverted fixed elements
						if($invertedFixedElements !== null) {
						
							if(options.position == 'right') {
							
								var invertedPosition = 'left';
								
							}
							else if(options.position == 'left') {
							
								var invertedPosition = 'right';
							
							}
							else if(options.position == 'top') {
							
								var invertedPosition = 'bottom';
							
							}
							else {
							
								var invertedPosition = 'top';
							
							}
						
							// Create JSON
							var json = '{"' + invertedPosition + '" : "+=' + menuSize + 'px' + '"}';
							
							// Animate inverted elements
							$invertedFixedElements.animate($.parseJSON(json), options.speed, options.easing);
						
						}
						
						// Create JSON
						var json = '{"' + options.position + '" : "' + direction + menuSize + 'px' + '"}';
						
						$menu.animate($.parseJSON(json), options.speed, options.easing, function() {
						
							// onClosed callback
							options.onClosed.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
							
							// Animation flag
							isAnimating = false;
							
							// Open flag
							isOpen = false;
							
							// onClosed callback
							options.onClosed.call(this);
							
							// onToggled callback
							options.onToggled.call(this);
							
							// Trigger window resize in case window was resized during animation
							$window.trigger('resize');
						
						});
					
					}
				
				}
			
			}	
			
			// Prevent FOUC by removing 'display' from the style
			// Don't do it if default positioed though as it should stay hidden
			if(options.preventFOUC === true && options.position != 'default') {
			
				$this.css('display', '');
			
			}
			
			// onInit callback
			options.onInit.call(this);			       
				
		});
	
	};

})(jQuery);