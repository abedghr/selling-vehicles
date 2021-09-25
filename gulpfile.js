var gulp = require('gulp');
var path = require('path');
var less = require('gulp-less');
var cssMin = require('gulp-cssmin');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var jsImport = require('gulp-js-import');

gulp.task('less', function () {
    'use strict';

    return gulp.src('frontend/assets/gulp/all.less')
        .pipe(concat('site.css'))
        .pipe(less())
        .pipe(cssMin())
        .pipe(gulp.dest('frontend/web/css'));

});

gulp.task('js', function () {
    'use strict';

    return gulp.src('frontend/assets/gulp/all.js')
        .pipe(jsImport({
            hideConsole: true,
            importStack: true
        }))
        .pipe(concat('site.js'))
        .pipe(uglify())
        .pipe(gulp.dest('frontend/web/js'));
});

gulp.task('watch', function () {
    gulp.watch('frontend/assets/gulp/less/**/*.less', gulp.series('less'));
    gulp.watch('frontend/assets/gulp/js/**/*.js', gulp.series('js'));
});
gulp.task('default', gulp.series('less', 'js'));
gulp.task('watch', gulp.series('less', 'js','watch'));