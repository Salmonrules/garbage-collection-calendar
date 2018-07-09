'use strict';

module.exports = function(gulp, config) {
    return function() {
        var sourcemaps = require('gulp-sourcemaps'),
            sass = require('gulp-sass');
        
        return gulp.src(config.sass.src)
            .pipe(sourcemaps.init())
            .pipe(sass({
                includePaths: config.sass.includePaths,
                outputStyle: 'compressed'
            }))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest(config.sass.dest));
    };
};
