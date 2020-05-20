var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
/*
let cleanCSS = require('gulp-clean-css');
let purge = require('gulp-css-purge');
*/




gulp.task('styles', function () {

    var stream = gulp.src('./sass/style.scss')
        .pipe(sourcemaps.init()) // add this
        .pipe(sass())
        
     /*   .pipe(cleanCSS({compatibility: 'ie9',level: 2}))
        .pipe(purge({
        trim : true,
        shorten : true,
        verbose : true
    })) */
        .pipe(sourcemaps.write('../css/')) // add this
        .pipe(gulp.dest('../vsc-theme/css/'));




    return stream;
});

gulp.task('mobile', function () {

    var stream = gulp.src('./sass/mobile.scss')
        .pipe(sourcemaps.init()) // add this
        .pipe(sass())
        /*   .pipe(cleanCSS({compatibility: 'ie9',level: 2}))
          .pipe(purge({
          trim : true,
          shorten : true,
          verbose : true
      })) */
        .pipe(sourcemaps.write('../css/')) // add this
        .pipe(gulp.dest('../vsc-theme/css/'));




    return stream;
});

gulp.task('header', function () {

    var stream = gulp.src('./sass/header.scss')
        .pipe(sourcemaps.init()) // add this
        .pipe(sass())
        /*   .pipe(cleanCSS({compatibility: 'ie9',level: 2}))
         .pipe(purge({
         trim : true,
         shorten : true,
         verbose : true
     })) */
        .pipe(sourcemaps.write('../css/')) // add this
        .pipe(gulp.dest('../vsc-theme/css/'));




    return stream;
});

//Watch task
gulp.task('watch',function() {
    gulp.watch('./sass/**/*.scss',['styles','mobile','header']);

});