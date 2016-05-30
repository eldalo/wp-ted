var gulp    = require('gulp'),
    sass    = require('gulp-sass'),
    concat  = require('gulp-concat'),
    bowerFiles   = require('main-bower-files'),
    autoprefixer = require('gulp-autoprefixer'),
    uglify  = require('gulp-uglify'),
    jshint  = require('gulp-jshint'),
    rename  = require('gulp-rename'),
    notify  = require('gulp-notify'),
    minifyCSS = require('gulp-minify-css');

var paths = {
        in : {
            bower      : 'resources/bower_components/',
            components : 'resources/components/',
            scripts    : 'resources/js/',
            sass       : 'resources/sass/'
        },
        out : {
            components : 'resources/components',
            fonts      : 'fonts',
            scripts    : 'js',
            styles     : 'css'
        }
    };

var files = {
        css    : '*.css',
        js     : '*.js',
        sass   : '*/*.scss',
        script : 'script.js',
        style  : 'style.scss'
    };

gulp.task('styles', function() {
    return gulp.src( paths.in.sass + files.style )
            .pipe( sass({ errLogToConsole: true }) )
            .pipe( autoprefixer('last 5 version') )
            .pipe( rename({ suffix: '.min' }) )
            .pipe( minifyCSS() )
            .pipe( gulp.dest(paths.out.styles) )
            .pipe( notify( function(file) {
                return 'SASS Compiler file: '+ file.relative;
            }) );
});

gulp.task('scripts', function() {
    return gulp.src( paths.in.scripts + files.script )
        .pipe( jshint('.jshintrc') )
        .pipe( jshint.reporter('default') )
        .pipe( rename({ suffix: '.min' }) )
        .pipe( uglify() )
        .pipe( gulp.dest(paths.out.scripts) )
        .pipe( notify( function(file) {
            return 'Scripts Compiler file: '+ file.relative;
        }) );
});


gulp.task('bower', function() {
    return gulp.src( bowerFiles() )
            .pipe( gulp.dest(paths.out.components) );
});

gulp.task('bower_styles', function() {
    return gulp.src( paths.in.components + files.css )
            .pipe( concat('components.min.css') )
            .pipe( minifyCSS() )
            .pipe( gulp.dest(paths.out.styles) )
            .pipe( notify( function(file) {
                return 'Bower CSS Compiler file: '+ file.relative;
            }) );
});

gulp.task('bower_scripts', function() {
    return gulp.src( paths.in.components + files.js )
        .pipe( concat('components.min.js') )
        .pipe( uglify() )
        .pipe( gulp.dest(paths.out.scripts) )
        .pipe( notify( function(file) {
            return 'Bower JS Compiler file: '+ file.relative;
        }) );
});


gulp.task('watch', function() {
    gulp.watch( paths.in.sass + files.sass, ['styles'] );
    gulp.watch( paths.in.scripts + files.js, ['scripts'] );
    gulp.watch( paths.in.bower + '**', ['bower'] );
    gulp.watch( paths.in.components + files.css, ['bower_styles'] );
    gulp.watch( paths.in.components + files.js, ['bower_scripts'] );
});

gulp.task('default', [ 'styles', 'scripts', 'bower', 'bower_styles', 'bower_scripts', 'watch' ]);
