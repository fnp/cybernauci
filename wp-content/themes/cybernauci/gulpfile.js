var gulp = require('gulp');
var less = require('gulp-less');
var concat = require('gulp-concat');
var imagemin = require('gulp-imagemin');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var browserSync = require('browser-sync').create();
var reload = browserSync.reload;

gulp.task('browser-sync', function () {
    var files = [
        './css/style.css',
        './*.php'
    ];

    browserSync.init(files, {
        open: 'external',
        host: 'cybernauci.local',
        proxy: 'cybernauci.local',
        port: 8080,
        watchOptions: {
            debounceDelay: 2000 // This introduces a small delay when watching for file change events to avoid triggering too many reloads
        }
    });
});

gulp.task('less', function () {
    gulp.src('./css/src/*.less')
        .pipe(plumber(plumberErrorHandler))
        .pipe(less())
        .pipe(gulp.dest('./css'))
        .pipe(reload({stream: true}));
});
gulp.task('js', function () {
    gulp.src('js/src/*.js')
        .pipe(concat('theme.js'))
        .pipe(gulp.dest('js'))
        .pipe(reload({stream: true}));
});
gulp.task('img', function () {
    gulp.src('img/src/*.{png,jpg,jpeg,gif,svg}')
        .pipe(imagemin({
            optimizationLevel: 7,
            progressive: true
        }))
        .pipe(gulp.dest('img'))
});

gulp.task('watch', function () {
    gulp.watch('css/src/*.less', ['less']);
    gulp.watch('js/src/*.js', ['js']);
    gulp.watch('img/src/*.{png,jpg,jpeg,gif,svg}', ['img']);
});

var plumberErrorHandler = {
    errorHandler: notify.onError({
        title: 'Gulp',
        message: 'Error: <%= error.message %>'
    })
};

gulp.task('default', ['less', 'js', 'img', 'watch', 'browser-sync']);