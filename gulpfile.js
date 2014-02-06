var gulp = require('gulp');
var minify = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');

gulp.task('css', function(){
	return gulp.src('laravel/public/sass/screen.scss')
		.pipe(sass({
			outputStyle: 'compressed',
			onError: function(e) {
				console.log(e)
			}
		}))
 		.pipe(autoprefixer('last 20 versions', '> 5%'))
		.pipe(gulp.dest('laravel/public/stylesheets/'));
})

gulp.task('default', ['css'], function(){
	gulp.watch('laravel/public/sass/*.scss', ['css']);
})