'use strict';

const gulp = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

gulp.task('js', () => {
  gulp.src(
    [
      './resources/template/assets/js/twitterFetcher.js',
      './resources/template/assets/js/template.js',
    ]
  )
  .pipe(babel({
    presets: ['env']
  }))
  .pipe(uglify())
  .pipe(concat('widget.js'))
  .pipe(gulp.dest('./resources/template/build'));
});

gulp.task('default', () => {
  gulp.watch('./resources/template/assets/js/*.js', ['js']);
});

gulp.task('build', ['js']);
