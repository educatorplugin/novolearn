(function($) {
	'use strict';

	/**
	 * Initialize fixed header.
	 */
	var initHeaderScroll = function() {
		var win = $(window),
		    header = $('#js-header'),
		    toolbarHeight = $('#js-top-toolbar').length ? 46 : 0,
		    headerResizeOffset = 134,
		    firstCall = true,
		    hasTransitions = false;

		if (!header.data('fixed')) {
			return;
		}

		var setFixed = function() {
			header.addClass('header_scroll');
		};

		var unsetFixed = function() {
			header.removeClass('header_scroll');
		};

		var isFixed = function() {
			return header.hasClass('header_scroll');
		};

		var setSmall = function() {
			header.addClass('header_small');
		};

		var unsetSmall = function() {
			header.removeClass('header_small');
		};

		var isSmall = function() {
			return header.hasClass('header_small');
		};

		var updateHeaderDimensions = function() {
			var scrollTop = win.scrollTop();

			if (!hasTransitions && !firstCall) {
				header.addClass('header_transition');
				hasTransitions = true;
			}

			firstCall = false;

			if (scrollTop >= toolbarHeight) {
				if (!isFixed()) {
					if (window.requestAnimationFrame) {
						requestAnimationFrame(setFixed);
					} else {
						setFixed();
					}
				}
			} else {
				if (isFixed()) {
					if (window.requestAnimationFrame) {
						requestAnimationFrame(unsetFixed);
					} else {
						unsetFixed();
					}
				}
			}

			if (scrollTop >= headerResizeOffset) {
				if (!isSmall()) {
					if (window.requestAnimationFrame) {
						requestAnimationFrame(setSmall);
					} else {
						setSmall();
					}
				}
			} else {
				if (isSmall()) {
					if (window.requestAnimationFrame) {
						requestAnimationFrame(unsetSmall);
					} else {
						unsetSmall();
					}
				}
			}
		};

		win.on('scroll', updateHeaderDimensions);
	};

	/**
	 * Initialize the search feature in the header.
	 */
	var initHeaderSearch = function() {
		var triggerEl = $('#js-search-trigger');
		var searchEl = $('#js-header-search');
		var body = $('body');

		var completeOpen = function() {
			searchEl.find('input[name="s"]').focus();
			body.one('click.novoHeaderSearch', function(e) {
				close();
			});
		};

		var open = function() {
			searchEl.css('display', 'block');

			if (transitionEndEvent) {
				searchEl.get(0).offsetWidth;
				searchEl.off(transitionEndEvent);
				searchEl.one(transitionEndEvent, completeOpen);
				searchEl.addClass('open');
			} else {
				completeOpen();
				searchEl.addClass('open');
			}
		};

		var completeClose = function() {
			searchEl.css('display', 'none');
		};

		var close = function() {
			body.off('click.novoHeaderSearch');

			if (transitionEndEvent) {
				searchEl.off(transitionEndEvent);
				searchEl.one(transitionEndEvent, completeClose);
			} else {
				completeClose();
			}

			searchEl.removeClass('open');
		};

		var isOpen = function() {
			return searchEl.hasClass('open');
		};

		searchEl.on('click', function(e) {
			e.stopPropagation();
		});

		triggerEl.on('click', function(e) {
			if (isOpen()) {
				close();
			} else {
				open();
			}

			e.preventDefault();
			e.stopPropagation();
		});
	};

	/**
	 * Initialize submenus in the main menu.
	 */
	var initSubMenu = function() {
		var menuEl = $('#menu-primary-menu');
		var subMenuWidth = parseInt(menuEl.find('.sub-menu').css('width'), 10);
		var win = $(window);
		var hideTimeouts = {};

		var showSubMenu = function(item) {
			var subMenu = item.find('> .sub-menu');

			subMenu.css('display', 'block');

			if (transitionEndEvent) {
				subMenu.get(0).offsetWidth;
				subMenu.off(transitionEndEvent);
			}

			item.addClass('menu-item_active');
		};

		var hideSubMenu = function(item) {
			var subMenu = item.find('> .sub-menu');
			var complete = function(e) {
				if (!e || (e.target && e.target.nodeName == 'UL')) {
					subMenu.css('display', 'none');
					subMenu.off(transitionEndEvent);
				}
			};

			if (transitionEndEvent) {
				subMenu.off(transitionEndEvent);
				subMenu.on(transitionEndEvent, complete);
			} else {
				complete();
			}

			item.removeClass('menu-item_active');
		};

		if (isNaN(subMenuWidth)) {
			subMenuWidth = 0;
		}

		menuEl.on('mouseenter', 'li', function() {
			var item = $(this),
			    id = item.attr('id'),
			    subMenu = item.find('> .sub-menu'),
			    subMenuOffset;

			if (subMenu.length) {
				if (item.parent().hasClass('sub-menu')) {
					subMenuOffset = item.offset().left + item.outerWidth();

					if (subMenuOffset + subMenuWidth > win.width()) {
						subMenu.removeClass('sub-menu_east')
							.addClass('sub-menu_west');
					} else {
						subMenu.removeClass('sub-menu_west')
							.addClass('sub-menu_east');
					}
				}

				if (hideTimeouts[id]) {
					clearTimeout(hideTimeouts[id]);
					hideTimeouts[id] = null;
				} else {
					showSubMenu(item);
				}
			}
		});

		menuEl.on('mouseleave', 'li', function() {
			var item = $(this);
			var id = item.attr('id');

			if (item.find('> .sub-menu').length) {
				hideTimeouts[id] = setTimeout(function() {
					hideSubMenu(item);
					hideTimeouts[id] = null;
				}, 300);
			}
		});
	};

	/**
	 * Initialize the drop-down element.
	 */
	var initNovoDropdown = function() {
		var show = function(dropdownEl) {
			var menuEl = dropdownEl.find('> .menu');

			menuEl.css('display', 'block');

			if (transitionEndEvent) {
				menuEl.off(transitionEndEvent);
				menuEl.get(0).offsetWidth;
			}

			dropdownEl.addClass('novo-dropdown_open');
		};

		var hide = function(dropdownEl) {
			var menuEl = dropdownEl.find('> .menu');
			var complete = function(e) {
				if (!e || (e.target && e.target.nodeName == 'UL')) {
					menuEl.css('display', 'none');
					menuEl.off(transitionEndEvent);
				}
			};

			if (transitionEndEvent) {
				menuEl.off(transitionEndEvent);
				menuEl.on(transitionEndEvent, complete);
			} else {
				complete();
			}

			dropdownEl.removeClass('novo-dropdown_open');
		};

		var shown = function(dropdownEl) {
			return dropdownEl.hasClass('novo-dropdown_open');
		};

		$('.novo-dropdown').each(function() {
			var dropdownEl = $(this);

			dropdownEl.on('mouseenter', function() {
				show($(this));
			});

			dropdownEl.on('mouseleave', function() {
				hide($(this));
			});

			dropdownEl.on('click', '.js-nd-label', function() {
				if (shown(dropdownEl)) {
					hide(dropdownEl);
				} else {
					show(dropdownEl);
				}
			});
		});
	};

	/**
	 * Initialize the featured image on the "Subpages" page template.
	 */
	var initPageFeaturedImage = function() {
		var description,
		    alignDescription,
		    win,
		    image = $('#page-featured-image');

		if (image.length) {
			description = image.find('.description');

			if (description.length) {
				image.imagesLoaded(function() {
					win = $(window);
					alignDescription = function() {
						var imageHeight = image.height();
						var descriptionHeight = description.outerHeight();
						var newPosTop = (imageHeight - descriptionHeight) / 2;

						description.css({
							top: newPosTop + 'px'
						});
					};
					alignDescription();
					win.on('resize', alignDescription);
				});
			}
		}
	};

	/**
	 * Detect the transitionend event name.
	 */
	var transitionEndEvent = (function() {
		var eventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'transition': 'transitionend'
		};

		return eventNames[Modernizr.prefixed('transition')];
	})();

	var init = function() {
		// Initialize mobile menu.
		$('#js-mobile-nav').superNav();

		initSubMenu();
		initHeaderScroll();
		initHeaderSearch();
		initNovoDropdown();
		initPageFeaturedImage();
	};

	init();
})(jQuery);
