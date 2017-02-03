var gulp = require("gulp"),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    htmlmin = require('gulp-html-minifier'),
    clean = require('gulp-clean'),
    browserify = require('gulp-browserify'),
    sass = require('gulp-sass');

var bases = {
	dist: "dist/"
};