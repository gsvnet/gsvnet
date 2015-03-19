var gulp = require('gulp');
var minify = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var sass = require('gulp-sass');

gulp.task('css', function(){
	gulp.src('resources/assets/front/sass/screen.scss')
        .pipe(sass())
 		.pipe(minify())
 		.pipe(autoprefixer())
		.pipe(gulp.dest('public/stylesheets/'));
});

gulp.task('images', function(){
  return gulp.src([
      'resources/assets/front/images/**/*.jpg',
      'resources/assets/front/images/**/*.png',
      'resources/assets/front/images/**/*.gif'
    ])
    .pipe(imagemin())
    .pipe(gulp.dest('public/images/'));
})

gulp.task('scripts', function() {
  return gulp.src([
      'resources/assets/components/javascripts/modernizr.js',
      'resources/assets/components/javascripts/jquery-1.10.1.min.js',
      'resources/assets/components/javascripts/list-to-menu.js',
      'resources/assets/components/javascripts/load-image.min.js',
      'resources/assets/components/javascripts/matchmedia.js',
      'resources/assets/components/javascripts/picturefill.js',
      'resources/assets/components/javascripts/list.min.js',
      'resources/assets/components/javascripts/list.fuzzysearch.min.js',
      'resources/assets/components/javascripts/jquery.touchSwipe.min.js',
      'resources/assets/components/javascripts/carousel.js',
      'resources/assets/components/javascripts/magnific-popup-0.9.9.js',
      'resources/assets/components/javascripts/magnific-popup-translation.js',
      'resources/assets/front/javascripts/tabs.js',
      'resources/assets/front/javascripts/forum.js',
      'resources/assets/front/javascripts/menu.js',
      'resources/assets/front/javascripts/touch-on-carousel.js',
      'resources/assets/front/javascripts/word-lid.js',
      'resources/assets/front/javascripts/app.js'
    ])
    .pipe(concat("app.js"))
    .pipe(uglify())
    .pipe(gulp.dest('public/build-javascripts/'))
});

gulp.task('backend-scripts', function() {
  return gulp.src([
      './bower_components/jquery/dist/jquery.min.js',
      'resources/assets/components/javascripts/bootstrap.js',
      'resources/assets/components/javascripts/selectize.0.12.0.js',
      'resources/assets/components/javascripts/dropzone.js',
      'resources/assets/components/javascripts/jquery.tablesorter.min.js',
      'resources/assets/back/javascripts/multi-upload.js',
      './bower_components/pickadate/lib/compressed/picker.js',
      './bower_components/pickadate/lib/compressed/picker.date.js',
      './bower_components/pickadate/lib/compressed/picker.time.js',
      './bower_components/pickadate/lib/translations/nl_NL.js',
      'resources/assets/back/javascripts/general.js'
    ])
    .pipe(concat("admin.js"))
    .pipe(uglify())
    .pipe(gulp.dest('public/build-javascripts/'))
});

gulp.task('backend-css', function() {
   return gulp.src([
       'resources/assets/components/css/selectize.min.css',
       'resources/assets/components/css/selectize.bootstrap3.min.css',
       './bower_components/pickadate/lib/compressed/themes/classic.css',
       './bower_components/pickadate/lib/compressed/themes/classic.date.css',
       './bower_components/pickadate/lib/compressed/themes/classic.time.css',
       'resources/assets/back/css/admin.css'
   ])
   .pipe(concat("admin.css"))
   .pipe(minify())
   .pipe(autoprefixer())
   .pipe(gulp.dest('public/stylesheets/'));
});

gulp.task('default', ['scripts', 'css'], function(){
  gulp.watch('resources/assets/**/*.js', ['scripts', 'backend-scripts']);
  gulp.watch('resources/assets/**/*', ['css', 'backend-css']);
});