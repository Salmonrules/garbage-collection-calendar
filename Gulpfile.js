'use strict';

var gulp = require('gulp'),
    taskLoader = require('gulp-simple-task-loader'),
    config = require('./config.json');

taskLoader({
    taskDirectory: 'tasks',
    config: config
}, gulp);