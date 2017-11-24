'use strict';

const gulp = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

gulp.task('js', () => {
  gulp.src('./resources/template/assets/js/*.js')
  .pipe(babel({
    presets: ['env']
  }))
  .pipe(uglify())
  .pipe(gulp.dest('./resources/template/build'));
});

gulp.task('default', () => {
  gulp.watch('./resources/template/assets/js/*.js', ['js']);
});

gulp.task('build', ['js']);
