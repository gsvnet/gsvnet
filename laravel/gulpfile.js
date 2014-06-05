var gulp = require('gulp');
var minify = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var compass = require('gulp-compass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var beautify = require('gulp-beautify');
var imagemin = require('gulp-imagemin');

gulp.task('css', function(){
	return gulp.src('assets/src/front/sass/screen.scss')
		.pipe(compass({
			config_file: 'config.rb',
			sass: 'assets/src/front/sass',
      css: 'public/stylesheets'
		}))
    .on('error', function(err) {
      console.log('Compass error: ' + err);
    })
 		.pipe(minify())
 		.pipe(autoprefixer('last 20 versions', '> 5%'))
		.pipe(gulp.dest('public/stylesheets/'));
});

gulp.task('images', function(){
  return gulp.src([
      'assets/src/front/images/**/*.jpg',
      'assets/src/front/images/**/*.png',
      'assets/src/front/images/**/*.gif'
    ])
    .pipe(imagemin())
    .pipe(gulp.dest('public/images-min/'));
})

gulp.task('scripts', function() {
  return gulp.src([
      'assets/src/components/javascripts/modernizr.js',
      'assets/src/components/javascripts/jquery-1.10.1.min.js',
      'assets/src/components/javascripts/list-to-menu.js',
      'assets/src/components/javascripts/load-image.min.js',
      'assets/src/components/javascripts/matchmedia.js',
  		'assets/src/components/javascripts/picturefill.js',
      'assets/src/components/javascripts/list.min.js',
      'assets/src/components/javascripts/list.fuzzysearch.min.js',
  		'assets/src/components/javascripts/jquery.touchSwipe.min.js',
  		'assets/src/components/javascripts/carousel.js',
      'assets/src/components/javascripts/magnific-popup-0.9.9.js',
      'assets/src/components/javascripts/magnific-popup-translation.js',
      'assets/src/front/javascripts/forum.js',
      'assets/src/front/javascripts/menu.js',
      'assets/src/front/javascripts/touch-on-carousel.js',
      'assets/src/front/javascripts/word-lid.js',
      'assets/src/front/javascripts/app.js'
    ])
    .pipe(concat("app.js"))
    .pipe(uglify())
    .pipe(gulp.dest('public/build-javascripts/'))
});

gulp.task('backend-scripts', function() {
  return gulp.src([
      'assets/src/components/javascripts/jquery-1.10.1.min.js',
      'assets/src/components/javascripts/bootstrap.js',
      'assets/src/components/javascripts/typeahead.js',
      'assets/src/components/javascripts/dropzone.js',
      'assets/src/components/javascripts/jquery.tablesorter.min.js',
      'assets/src/back/javascripts/multi-upload.js',
      'assets/src/back/javascripts/general.js'
    ])
    .pipe(concat("admin.js"))
    .pipe(uglify())
    .pipe(gulp.dest('public/build-javascripts/'))
});

gulp.task('default', ['scripts', 'css'], function(){
  gulp.watch('assets/src/front/javascripts/**/*.js', ['scripts']);
  gulp.watch('assets/src/front/sass/**/*.scss', ['css']);
});