'use strict';

module.exports = function(gulp, config) {
    return function() {
        var sourcemaps = require('gulp-sourcemaps'),
            uglify = require('gulp-uglify'),
            concat = require('gulp-concat'),
            gutil = require('gulp-util');

        return gulp.src(config.javascript.items.src)
            .pipe(concat('site.min.js'))
            .pipe(sourcemaps.init())        
            .pipe(sourcemaps.write())
            .pipe(gulp.dest(config.javascript.items.dest));
    };
};
