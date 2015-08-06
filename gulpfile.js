// Require plugins
var gulp = require('gulp'),
	rename = require('gulp-rename'),
	plumber = require('gulp-plumber'),
	cache = require('gulp-cache'),
	util = require('gulp-util'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	autoprefixer = require('gulp-autoprefixer'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin');

var config = {
	src: 'resources/assets/',
	dest: 'public/',
	sassPattern: 'sass/**/*.+(scss|sass)',
	jsPattern: 'js/**/*.js',
	imgPattern: 'img/**/*.+(jpg|jpeg|png|gif|svg)',
	production: !!util.env.production // Those two exclamations turn undefined into a proper false.
};

// Tasks
gulp.task('css', function(){
	gulp.src(config.src + config.sassPattern)
	.pipe(plumber())
	.pipe(config.production ? util.noop() : sourcemaps.init())
	.pipe(sass({
		outputStyle: (config.production ? 'compressed' : 'nested')
	}))
	.pipe(rename({
		suffix: '.min'
	}))
	.pipe(autoprefixer({
		browsers: ['last 3 versions']
	}))
	.pipe(config.production ? util.noop() : sourcemaps.write())
	.pipe(gulp.dest(config.dest + 'css'))
});

gulp.task('js', function(){
	gulp.src(config.src + config.jsPattern)
	.pipe(plumber())
	.pipe(config.production ? uglify() : util.noop())
	.pipe(rename({
		suffix: '.min'
	}))
	.pipe(gulp.dest(config.dest + 'js'))
});

gulp.task('img', function(){
	return gulp.src(config.src + imgPattern)
    .pipe(cache(imagemin({
    	optimizationLevel: 3,
    	progressive: true,
    	interlaced: true
    })))
    .pipe(gulp.dest(config.dest + 'img'));
});

gulp.task('clear', function(done){
	return cache.clearAll(done);
});

// Watch task
gulp.task('watch', function(){
	gulp.watch(config.src + config.sassPattern, ['css']);
	gulp.watch(config.src + config.jsPattern, ['js']);
});

// Default task
gulp.task('default', ['css', 'js', 'watch']);
