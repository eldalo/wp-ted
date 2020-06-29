var gulp = require('gulp');
var bowerFiles = require('main-bower-files');
var $ = require('gulp-load-plugins')({ lazy: true });

var paths = {
  resources: {
    javascript: 'resources/js/',
    sass: 'resources/sass/',
    images: 'resources/images/'
  },
  public: {
    fonts: 'fonts',
    scripts: 'js',
    styles: 'css',
    images: 'images'
  }
};

var fileExt = {
  css: '*.css',
  js: '*.js',
  sass: '*/*.scss',
  script: 'script.js',
  styleSASS: 'style.scss',
  all: '**'
};

gulp.task('styles', function () {
  return gulp.src(paths.resources.sass + fileExt.styleSASS)
    .pipe($.sass().on('error', $.sass.logError))
    .pipe($.autoprefixer('last 5 version'))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.cleanCss())
    .pipe(gulp.dest(paths.public.styles))
    .pipe($.notify(function (file) {
      return 'Compiler styles file: ' + file.relative;
    }));
});

gulp.task('scripts', function () {
  return gulp.src(paths.resources.javascript + fileExt.script)
    .pipe($.plumber())
    .pipe($.babel({
      presets: ['@babel/env']
    }))
    .pipe($.rename({ suffix: '.min' }))
    .pipe($.uglify())
    .pipe(gulp.dest(paths.public.scripts))
    .pipe($.notify(function (file) {
      return 'Compiler scripts file: ' + file.relative;
    }));
});

gulp.task('stylesBower', function () {
  return gulp.src(bowerFiles('**/' + fileExt.css))
    .pipe($.concat('components.min.css'))
    .pipe($.cleanCss())
    .pipe(gulp.dest(paths.public.styles))
    .pipe($.notify(function (file) {
      return 'Compiler Bower styles file: ' + file.relative;
    }));
});

gulp.task('scriptsBower', function () {
  return gulp.src(bowerFiles('**/' + fileExt.js))
    .pipe($.concat('components.min.js'))
    .pipe($.uglify())
    .pipe(gulp.dest(paths.public.scripts))
    .pipe($.notify(function (file) {
      return 'Compiler Bower scripts file: ' + file.relative;
    }));
});

gulp.task('images', function () {
  return gulp.src(paths.resources.images + fileExt.all)
    .pipe($.changed('images'))
    .pipe($.imagemin({
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest(paths.public.images))
    .pipe($.size({ title: 'images' }))
    .pipe($.notify(function (file) {
      return 'Optimizes the images: ' + file.relative;
    }));
});

gulp.task('watch', function () {
  gulp.watch(paths.resources.sass + fileExt.sass, ['styles']);
  gulp.watch(paths.resources.javascript + fileExt.js, ['scripts']);
});

gulp.task('default', function () {
  gulp.start(
    'styles',
    'scripts',
    'stylesBower',
    'scriptsBower',
    'watch'
  );
});
