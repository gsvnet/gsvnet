var gulp = require('gulp');
var minify = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var compass = require('gulp-compass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var beautify = require('gulp-beautify');
var imagemin = require('gulp-imagemin');
var sprite = require('gulp-sprite');

gulp.task('sprite', function(){
  return gulp.src('assets/src/sprite-images/**/*.png')
    .pipe(sprite('sprite.png', {
      imagePath: 'public/images/',
      cssPath: 'assets/src/sass/icons',
      preprocessor: 'scss'
    }))
    .pipe(gulp.dest('public/images/'));
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
		.pipe(gulp.dest('public/tmp/'));
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
      'assets/javascripts/components/modernizr.js',
      'assets/javascripts/components/jquery-1.10.1.min.js',
      'assets/javascripts/components/list-to-menu.js',
      'assets/javascripts/components/load-image.min.js',
      'assets/javascripts/components/matchmedia.js',
  		'assets/javascripts/components/picturefill.js',
      'assets/javascripts/components/list.min.js',
  		'assets/javascripts/components/list.fuzzysearch.min.js',
  		'assets/javascripts/components/carousel.js',
      'assets/javascripts/components/magnific-popup-0.9.9.js',
      'assets/javascripts/components/magnific-popup-translation.js',
  		'assets/javascripts/menu.js',
  		'assets/javascripts/word-lid.js',
  		'assets/javascripts/app.js'
  	])
    .pipe(concat("app.js"))
  	.pipe(uglify())
    .pipe(gulp.dest('public/build-javascripts/'))
});

gulp.task('default', ['scripts', 'css'], function(){
  gulp.watch('assets/javascripts/**/*.js', ['scripts']);
  gulp.watch('assets/src/sass/**/*.scss', ['css']);
});

gulp.task('watch-scripts', ['scripts'], function(){
  gulp.watch('assets/javascripts/*.js', ['scripts']);
});

gulp.task('watch-css', ['css'], function(){
  gulp.watch('assets/src/sass/**/*.scss', ['css']);
});