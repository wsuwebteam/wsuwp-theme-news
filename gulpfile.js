const gulp = require('gulp');
const { src, series, parellel, dest, watch } = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const sass = require('gulp-sass');
const minify = require('gulp-minify');
const cleanCSS = require('gulp-clean-css');

const components = [
    'components/global-header/'
]



gulp.task('styles', () => {
    return gulp.src('src/scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(gulp.dest('./'));
});

gulp.task('bundleStyle', () => {
    return gulp.src('src/bundles/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(cleanCSS({compatibility: 'ie11'}))
        .pipe(gulp.dest('dist/bundles/'));
});


gulp.task('watch', () => {
    gulp.watch('src/scss/partials/*.scss', (done) => {
        gulp.series(['styles'])(done);
    });

    //gulp.watch('src/elements/**/*.scss', (done) => {
       // gulp.series(['styles','bundleStyle'])(done);
    //});

});



