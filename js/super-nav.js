/**
 * @version 1.2
 */
(function($) {
	'use strict';

	function getBrowserEventName(eventNames) {
		var element = document.createElement('supernav'),
			name;

		for (name in eventNames) {
			if (element.style[name] !== undefined) {
				return eventNames[name];
			}
		}

		return '';
	}

	var transitionEnd = (function() {
		return getBrowserEventName({
			WebkitTransition: 'webkitTransitionEnd',
			transition:       'transitionend'
		});
	})();

	function SuperNav(menuEl, options) {
		this.menuEl = menuEl;
		this.triggerEl = $(menuEl.attr('data-trigger'));
		this.overlayEl = $('#js-super-nav-overlay');
		this.options = options;
		this.isOpen = false;

		this.setupEvents();
	}

	SuperNav.prototype = {
		setupEvents: function() {
			var that = this;

			if (this.triggerEl.length) {
				this.triggerEl.on('click', function(e) {
					that.open();
					e.preventDefault();
				});
			}

			this.overlayEl.on('click', function(e) {
				that.close();
				e.preventDefault();
			});

			this.menuEl.on('click', '.super-nav__close', function(e) {
				that.close();
				e.preventDefault();
			});
		},

		open: function() {
			if (this.isOpen) {
				return;
			}

			this.isOpen = true;

			switch (this.options.effect) {
				case 'slideInLeft':
					this.slideIn('left');
					break;

				case 'slideInRight':
					this.slideIn('right');
					break;
			}
		},

		close: function() {
			if (!this.isOpen) {
				return;
			}

			this.isOpen = false;

			this.slideOut();
		},

		slideIn: function(from) {
			var that = this;

			if (from === 'left') {
				this.menuEl.addClass('super-nav_left');
			} else {
				this.menuEl.addClass('super-nav_right');
			}

			this.overlayEl.css('display', 'block');

			if (transitionEnd && window.requestAnimationFrame) {
				this.menuEl.off(transitionEnd);
				this.menuEl.addClass('super-nav_before-open');
				this.menuEl.get(0).offsetWidth;

				requestAnimationFrame(function() {
					that.menuEl.addClass('super-nav_open');
					that.overlayEl.addClass('super-nav-overlay_open');
				});
			} else {
				that.menuEl.addClass('super-nav_before-open super-nav_open');
				that.overlayEl.addClass('super-nav-overlay_open');
			}
		},

		slideOut: function() {
			var that = this;
			var complete = function() {
				that.menuEl.removeClass('super-nav_open super-nav_close ' +
					'super-nav_left super-nav_right super-nav_before-open');
				that.overlayEl.css('display', 'none');
			};

			if (transitionEnd && window.requestAnimationFrame) {
				this.menuEl.off(transitionEnd);
				this.menuEl.on(transitionEnd, complete);

				requestAnimationFrame(function() {
					that.menuEl.addClass('super-nav_close');
					that.overlayEl.removeClass('super-nav-overlay_open');
				});
			} else {
				complete();
			}
		}
	};

	jQuery.fn.superNav = function(options) {
		options = $.extend({
			effect: 'slideInRight'
		}, options);

		return this.each(function() {
			var superNav = new SuperNav($(this), options);

			$.data(this, 'superNav', superNav);
		});
	};
})(jQuery);
