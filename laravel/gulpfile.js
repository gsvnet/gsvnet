var gulp = require('gulp');
var minify = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var compass = require('gulp-compass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var beautify = require('gulp-beautify');
var imagemin = require('gulp-imagemin');
var sprite = require('gulp-spritesmith');

gulp.task('sprite', function(){
  return gulp.src('assets/src/sprite-images/**/*.png')
    .pipe(sprite('sprite.png', {
      destImg: 'public/images/',
      destCSS: 'assets/src/sass/'
    }));
});

gulp.task('css', function(){
	return gulp.src('assets/src/sass/screen.scss')
		.pipe(compass({
			config_file: 'config.rb',
			sass: 'assets/src/sass',
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
      'assets/src/images/**/*.jpg',
      'assets/src/images/**/*.png',
      'assets/src/images/**/*.gif'
    ])
    .pipe(imagemin())
    .pipe(gulp.dest('public/images-min/'));
})

gulp.task('scripts', function() {
  return gulp.src([
      'assets/src/javascripts/components/modernizr.js',
      'assets/src/javascripts/components/jquery-1.10.1.min.js',
      'assets/src/javascripts/components/list-to-menu.js',
      'assets/src/javascripts/components/load-image.min.js',
      'assets/src/javascripts/components/matchmedia.js',
  		'assets/src/javascripts/components/picturefill.js',
      'assets/src/javascripts/components/list.min.js',
  		'assets/src/javascripts/components/list.fuzzysearch.min.js',
  		'assets/src/javascripts/components/carousel.js',
      'assets/src/javascripts/components/magnific-popup-0.9.9.js',
      'assets/src/javascripts/components/magnific-popup-translation.js',
  		'assets/src/javascripts/menu.js',
  		'assets/src/javascripts/word-lid.js',
  		'assets/src/javascripts/app.js'
  	])
    .pipe(concat("app.js"))
  	.pipe(uglify())
    .pipe(gulp.dest('public/build-javascripts/'))
});

gulp.task('default', ['scripts', 'css'], function(){
  gulp.watch('assets/src/javascripts/**/*.js', ['scripts']);
  gulp.watch('assets/src/sass/**/*.scss', ['css']);
});

gulp.task('watch-scripts', ['scripts'], function(){
  gulp.watch('assets/src/javascripts/*.js', ['scripts']);
});

gulp.task('watch-css', ['css'], function(){
  gulp.watch('assets/src/sass/**/*.scss', ['css']);
});