var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
var autoprefixer = require('gulp-autoprefixer');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify-es').default;
var imagemin = require('gulp-imagemin');
var sass = require('gulp-sass');
var webpack = require('webpack-stream');
var eventStream = require('event-stream');

gulp.task('css', function () {
    return gulp.src([
        'resources/assets/front/sass/screen.scss',
        './bower_components/flipdown/dist/flipdown.css'
    ])
        .pipe(sass())
        .pipe(cleanCSS())
        .pipe(autoprefixer())
        .pipe(concat('screen.css'))
        .pipe(gulp.dest('public/stylesheets/'));
});

gulp.task('homepage-css', function () {
    return gulp.src('resources/assets/front/sass/homepage.scss')
        .pipe(sass())
        .pipe(cleanCSS())
        .pipe(autoprefixer())
        .pipe(gulp.dest('public/stylesheets/'));
});

gulp.task('images', function () {
    return eventStream.merge(
        gulp.src([
            'resources/assets/front/images/**/*.svg'
        ])
            .pipe(gulp.dest('public/images/')),

        gulp.src([
            'resources/assets/front/images/**/*.jpg',
            'resources/assets/front/images/**/*.png',
            'resources/assets/front/images/**/*.gif'
        ])
            .pipe(imagemin())
            .pipe(gulp.dest('public/images/'))
    )
});

gulp.task('april-fools', function (done) {
    gulp.src([
        'resources/assets/front/sass/aprilfools.scss',
        'resources/assets/front/sass/ant.scss'
    ])
        .pipe(sass())
        .pipe(cleanCSS())
        .pipe(autoprefixer())
        .pipe(gulp.dest('public/stylesheets/'));
    gulp.src([
        'resources/assets/front/javascripts/april_fools/popup/index.js'
    ])
        //.pipe(concat("af.js"))
        .pipe(webpack({
            mode: 'production',
            output: {
                filename: 'af.js',
            },
            module: {
                rules: [
                    {
                        test: /\.js$/,
                        exclude: /node_modules/,
                        use: ['babel-loader']
                    }
                ]
            }
        }))
        //.pipe(uglify())
        .pipe(gulp.dest('public/build-javascripts/'));

    done();
    //return eventStream.concat(css, js);
});


gulp.task('homepage-scripts', function () {
    return gulp.src([
        './bower_components/jquery/dist/jquery.min.js',
        './bower_components/jquery-fracs/dist/jquery.fracs.min.js',
        './bower_components/instafeed.js/instafeed.min.js',
        'resources/assets/front/javascripts/index_new/Utils.js',
        'resources/assets/front/javascripts/index_new/mediaQueryListener.js',
        'resources/assets/front/javascripts/index_new/hashnavigation.js',
        'resources/assets/front/javascripts/index_new/scrollHandler.js',
        'resources/assets/front/javascripts/index_new/scrollresponse.js',
        'resources/assets/front/javascripts/index_new/fullHeightMobile.js',
        'resources/assets/front/javascripts/index_new/Rectangle.js',
        'resources/assets/front/javascripts/index_new/NavMenu.js',
        'resources/assets/front/javascripts/index_new/CoverVideo.js',
        'resources/assets/front/javascripts/index_new/Tabs.js',
        'resources/assets/front/javascripts/index_new/ImageZoom.js',
        'resources/assets/front/javascripts/index_new/googleMap.js',
        'resources/assets/front/javascripts/index_new/InstagramFeed.js'
    ])
        .pipe(babel({
            presets: ['@babel/env'],
            ignore: [
                './bower_components/jquery/dist/jquery.min.js',
                './bower_components/jquery-fracs/dist/jquery.fracs.min.js',
                './bower_components/instafeed.js/instafeed.min.js'
            ]
        }))
        .pipe(concat("homepage.js"))
        .pipe(uglify())
        .pipe(gulp.dest('public/build-javascripts/'));
});

gulp.task('scripts', function () {
    return gulp.src([
        'resources/assets/components/javascripts/modernizr.js',
        './bower_components/jquery/dist/jquery.min.js',
        './bower_components/socket.io-client/socket.io.js',
        './bower_components/flipdown/dist/flipdown.js',
        'resources/assets/components/javascripts/list-to-menu.js',
        'resources/assets/components/javascripts/load-image.min.js',
        'resources/assets/components/javascripts/list.min.js',
        'resources/assets/components/javascripts/list.fuzzysearch.min.js',
        'resources/assets/components/javascripts/carousel.js',
        'resources/assets/components/javascripts/magnific-popup-0.9.9.js',
        'resources/assets/components/javascripts/magnific-popup-translation.js',
        'resources/assets/front/javascripts/tabs.js',
        'resources/assets/front/javascripts/forum.js',
        'resources/assets/front/javascripts/menu.js',
        'resources/assets/front/javascripts/word-lid.js',
        'resources/assets/front/javascripts/receive-updates.js',
        'resources/assets/front/javascripts/app.js'
    ])
        .pipe(concat("app.js"))
        .pipe(uglify())
        .pipe(gulp.dest('public/build-javascripts/'));
});

gulp.task('forum-scripts', function () {
    return gulp.src([
        './bower_components/pica/dist/pica.min.js',
        './bower_components/flipdown/dist/flipdown.js',
        './resources/assets/components/javascripts/load-image.js',
        './resources/assets/front/javascripts/image-upload.js'
    ]).pipe(concat('forum.js')).pipe(uglify()).pipe(gulp.dest('public/build-javascripts/'));
});

gulp.task('backend-scripts', function () {
    return gulp.src([
        './bower_components/jquery/dist/jquery.min.js',
        'resources/assets/components/javascripts/bootstrap.min.js',
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
        .pipe(gulp.dest('public/build-javascripts/'));
});

gulp.task('backend-css', function () {
    return gulp.src([
        'resources/assets/components/css/selectize.min.css',
        'resources/assets/components/css/selectize.bootstrap3.min.css',
        './bower_components/pickadate/lib/compressed/themes/default.css',
        './bower_components/pickadate/lib/compressed/themes/default.date.css',
        './bower_components/pickadate/lib/compressed/themes/default.time.css',
        'resources/assets/back/css/admin.css'
    ])
        .pipe(concat("admin.css"))
        .pipe(cleanCSS())
        .pipe(autoprefixer())
        .pipe(gulp.dest('public/stylesheets/'));
});

gulp.task('default', gulp.series('scripts', 'css', function () {
    gulp.watch('resources/assets/**/*.js', gulp.series('scripts', 'backend-scripts', 'forum-scripts')); // 'homepage-scripts'
    gulp.watch(['resources/assets/**/*.scss', 'resources/assets/**/*.css'], gulp.series('css', 'backend-css')); //'homepage-css'
}));

gulp.task('watch-april-fools', gulp.series('april-fools', function () {
    gulp.watch('resources/assets/front/javascripts/april_fools/**/*.js', gulp.series('april-fools'));
    gulp.watch('resources/assets/front/sass/**/*.scss', gulp.series('april-fools'));
}));