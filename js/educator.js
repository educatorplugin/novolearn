(function($) {
	'use strict';

	/**
	 * Collapse/expand lessons on the single course page.
	 */
	var collapseLessons = function() {
		var lessonsEls = $('.edr-lessons');

		if (lessonsEls.length) {
			lessonsEls.each(function() {
				var el = $(this);

				el.children('li').each(function() {
					var lessonEl = $(this);

					if (lessonEl.find('.lesson-excerpt:first').length) {
						lessonEl.find('.lesson-header').append('<a class="handle" href="#"></a>');
					}
				});

				el.on('click', '.handle', function(e) {
					$(this).closest('.lesson').toggleClass('lesson_open');
					e.preventDefault();
				});
			});
		}
	};

	var init = function() {
		collapseLessons();
	};

	init();
})(jQuery);
