var gulp = require('gulp');
var minify = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var compass = require('gulp-compass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

gulp.task('css', function(){
	return gulp.src('laravel/public/sass/screen.scss')
		// TODO: werkt nog niet :(
		.pipe(compass({
			config_file: 'laravel/public/config.rb',
			css: 'laravel/public/stylesheets',
			sass: 'laravel/public/sass'
		}))
 		.pipe(minify())
 		.pipe(autoprefixer('last 20 versions', '> 5%'))
		.pipe(gulp.dest('laravel/public/stylesheets/'));
});

gulp.task('scripts', function() {
  return gulp.src([
      'laravel/public/javascripts/components/jquery-1.10.1.min.js',
      'laravel/public/javascripts/components/list-to-menu.js',
      'laravel/public/javascripts/components/load-image.min.js',
      'laravel/public/javascripts/components/matchmedia.js',
  		'laravel/public/javascripts/components/picturefill.js',
  		'laravel/public/javascripts/components/list.min.js',
  		'laravel/public/javascripts/components/carousel.js',
  		'laravel/public/javascripts/components/magnific-popup-0.9.9.js',
  		'laravel/public/javascripts/menu.js',
  		'laravel/public/javascripts/word-lid.js',
  		'laravel/public/javascripts/app.js'
  	])
  	.pipe(uglify())
    .pipe(concat("app.js"))
    .pipe(gulp.dest('laravel/public/build-javascripts/'))
});

gulp.task('default', ['css', 'scripts'], function(){
	gulp.watch('laravel/public/sass/*.scss', ['css']);
});