const {gulp, src, dest, series, watch} = require('gulp');
const less = require('gulp-less');
const sourcemaps = require('gulp-sourcemaps');
const svgSprite = require('gulp-svg-sprite'); 

var lessSrc = './frontend/web/less/style.less';
var cssDest = './frontend/web/css/';

var svgSrc = 'frontend/web/static/svg/*.svg';
var svgDest = 'frontend/web/static/';

// Сборка SVG-спрайта
const sprite = () => {
  return src(svgSrc)
      .pipe(svgSprite({
              mode: {
                  stack: {
                      sprite: "../sprite.svg"
                  }
              },
          }
      ))
      .pipe(dest(svgDest));
}

// Компиляция less в css
function less_compile () {
    return src(lessSrc)
        .pipe(less())
        .pipe(sourcemaps.init())
        .pipe(sourcemaps.write('./'))
        .pipe(dest(cssDest))
}



exports.watch = function () {
  watch('./frontend/web/less/**/*.less', less_compile)
  watch('frontend/web/static/svg/**/*.svg', sprite)
}

exports.less = less_compile;

exports.default = series(less_compile, sprite);
