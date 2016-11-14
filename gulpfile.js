'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

gulp.task('scss', function() {
	gulp.src('./css/scss/style.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./css'));
	gulp.src('./css/scss/educator.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./css'));
});

gulp.task('styles', ['scss'], function() {
	var stream = gulp.src([
			'./css/banner.css',
			'./css/normalize.css',
			'./css/style.css'
		])
		.pipe(concat('style.css'));

	stream.pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
	gulp.watch(
		[
			'./css/*.css',
			'./css/scss/**/*.scss'
		],
		['styles']
	);
});

gulp.task('default', ['styles']);
