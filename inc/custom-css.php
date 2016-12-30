body {
	color: <?php echo $body_color; ?>;
    font-family: <?php echo $body_font; ?>, Helvetica, Arial, sans-serif;
}

h1, h2, h3, h4, h5, h6 {
	color: <?php echo $headings_color; ?>;
	font-weight: <?php echo $headings_font_weight; ?>;
}

.header .site-title {
	font-weight: <?php echo $bold_font_weight; ?>;
}

.button_primary,
input.submit,
.search-form .search-submit,
.header-search button,
.post-password-form input[type="submit"],
.wpcf7-submit {
	background: <?php echo $main_color; ?>;
	color: #fff;
}

.button_primary:hover,
input.submit:hover,
.search-form .search-submit:hover,
.header-search button:hover,
.wpcf7-submit:hover {
	background: <?php echo $hover_color; ?>;
	color: #fff;
}

.main-nav .menu > .current-menu-item > a:after,
.main-nav .menu > li > .sub-menu:after,
.heading:before {
	background: <?php echo $main_color; ?>;
}

.main-nav .sub-menu a:hover,
.novo-dropdown li a:hover {
	background: #f5f5f5;
	color: <?php echo $body_color; ?>;
}

.page-sidebar a,
.comment-metadata a,
.entry-meta,
.entry-meta a,
.entry-footer,
.entry-footer a,
.novo-dropdown li a,
a.page-numbers,
.page-links a,
.main-nav .menu > li > a,
.main-nav .sub-menu a,
.novo-dropdown .novo-dropdown__label,
.social-links a,
.search-trigger,
.widget .post-date,
.widget_rss .rss-date,
.wp-caption-text,
.comment-awaiting-moderation,
.footer,
.footer a {
	color: #999;
}

.entry-title a,
.comment-author a,
.comment-author,
.super-nav__block__header {
	color: <?php echo $headings_color; ?>;
}

.nav-trigger span {
	background: #222;
}

.super-nav .menu a,
.post-navigation .post-title {
	color: <?php echo $body_color; ?>;
}

a,
.main-nav .menu > li:hover > a,
.main-nav .menu > .current-menu-item > a,
.search-trigger:hover,
.novo-dropdown_open .novo-dropdown__label,
.posts-grid .price,
.widget_nav_menu .current-menu-item > a,
.widget_pages .current_page_item > a {
	color: <?php echo $main_color; ?>;
}

.nl-post-lite.sticky .entry-header {
	border-color: <?php echo $main_color; ?>;
}

.nl-post-block.sticky .entry-summary:before {
	background: <?php echo $main_color; ?>;
}

<?php
// Educator related CSS.
if ( novolearn_educator_enabled() ) : ?>
.edr-form__legend,
.edr-payment-summary dt,
.edr-question .label,
.widget_lessons_list .group-title {
	font-weight: <?php echo $bold_font_weight; ?>;
}

.edr-course-info .edr-buy-widget__link,
.hentry_single.edr_membership .edr-buy-widget__link,
.edr-button,
.edr-membership__buy {
	background: <?php echo $main_color; ?>;
	color: #fff;
}

.edr-course-info .edr-buy-widget__link:hover,
.hentry_single.edr_membership .edr-buy-widget__link:hover,
.edr-button:hover,
.edr-membership__buy:hover {
	background: <?php echo $hover_color; ?>;
	color: #fff;
}

.edr-lessons .handle,
.edr-course__meta,
.edr-breadcrumbs,
.edr-lessons .lesson-excerpt,
.edr-course__meta a,
.edr-course__footer a {
	color: #999;
}

.edr-form__legend,
.widget_lessons_list .group-title,
.edr-course__title a,
.edr-membership__title a {
	color: <?php echo $headings_color; ?>;
}

.edr-meta a,
.edr-lessons .lesson-title,
.lessons-nav-links .lesson-title {
	color: <?php echo $body_color; ?>;
}

.edr-lessons .lesson-title:hover {
	color: <?php echo $hover_color; ?>;
}

.widget_lessons_list .current-lesson a,
.widget_course_categories .current-cat > a,
.edr-course .price,
.posts-list .price,
.edr-membership__price {
	color: <?php echo $main_color; ?>;
}
<?php endif; ?>

a:hover {
	color: <?php echo $hover_color; ?>;
}
