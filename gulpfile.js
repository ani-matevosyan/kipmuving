var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps   = require('gulp-sourcemaps'),
    babel        = require('gulp-babel'),
    uglify       = require('gulp-uglify'),
    pump         = require('pump'),
    rename       = require('gulp-rename');

gulp.task('sass', function(){
    return gulp.src('./public/scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 15 version'],
            cascade: false
        }))
        .pipe(sourcemaps.write("../maps"))
        .pipe(gulp.dest('./public/css'))
});

gulp.task('scripts', function(){
   return gulp.src('./public/js/src/*.js')
       .pipe(sourcemaps.init())
       // .pipe(uglify())
       .pipe(sourcemaps.write("../maps"))
       .pipe(gulp.dest("./public/js"));
});

gulp.task('compress', function(cb){
   pump(
       [
           gulp.src('./public/js/src/*.js'),
           uglify(),
           rename({ suffix: '.min' }),
           gulp.dest('./public/js')
       ],
       cb
   )
});

gulp.task('watch', ['sass', 'compress'], function() {
    gulp.watch('./public/scss/**/*.scss', ['sass']);
    gulp.watch('./public/js/src/*.js', ['compress']);
});

gulp.task('default', ['watch']);



// const elixir = require('laravel-elixir');
//
// require('laravel-elixir-vue-2');
//
// /*
//  |--------------------------------------------------------------------------
//  | Elixir Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Elixir provides a clean, fluent API for defining some basic Gulp tasks
//  | for your Laravel application. By default, we are compiling the Sass
//  | file for our application, as well as publishing vendor resources.
//  |
//  */
//
// elixir(mix => {
//     mix.sass('app.scss')
//        .webpack('app.js');
// });
