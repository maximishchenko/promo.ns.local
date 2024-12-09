var gulp = require('gulp');
var uglify = require('gulp-uglify');
var cssMin = require('gulp-css');
var rename = require('gulp-rename');
var minimist = require('minimist');
var svgSprite = require('gulp-svg-sprite'); //svg sprite
var options = minimist(process.argv.slice(2), {string: ['src', 'dist']});

// Use `compress-js` task for JavaScript files 
gulp.task('compress-js', function () {
    var destDir = options.dist.substring(0, options.dist.lastIndexOf("/"));
    var destFile = options.dist.replace(/^.*[\\\/]/, '');
    return gulp.src(options.src)
        .pipe(uglify())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
});

// Use `compress-css` task for CSS files
gulp.task('compress-css', function () {
    var destDir = options.dist.substring(0, options.dist.lastIndexOf("/"));
    var destFile = options.dist.replace(/^.*[\\\/]/, '');
    return gulp.src(options.src)
        .pipe(cssMin())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
});

// Use `svgSprite` task for make sprite
// gulp.task('svgSprite', function () {
//     return gulp.src('frontend/web/static/*.svg') // svg files for sprite
//         .pipe(svgSprite({
//                 mode: {
//                     stack: {
//                         sprite: "../sprite.svg" //sprite file name
//                     }
//                 },
//             }
//         ))
//         .pipe(gulp.dest('frontend/web/images/'));
// });