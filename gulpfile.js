var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps   = require('gulp-sourcemaps'),
    babel        = require('gulp-babel'),
    uglify       = require('gulp-uglify'),
    pump         = require('pump'),
    rename       = require('gulp-rename'),
    webpack      = require('webpack-stream'),
    named        = require('vinyl-named');

gulp.task('sass', function(){
    return gulp.src('./resources/assets/sass/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 15 version'],
            cascade: false
        }))
        .pipe(sourcemaps.write("../maps"))
        .pipe(gulp.dest('./public/css'))
});

gulp.task('scripts1', function(cb){
    pump(
        [
            gulp.src('./resources/assets/js/src1/**/*.js'),
            uglify(),
            rename({ suffix: '.min' }),
            gulp.dest('./public/js/')
        ],
        cb
    )
});

gulp.task('scripts2', function(cb){
    pump(
        [
            gulp.src('./resources/assets/js/src2/**/*.js'),
            babel({presets: ['es2015']}),
            named(),
            webpack({
                module:{
                    loaders: [
                        { test: /\.css$/, use: [ 'style-loader', 'css-loader' ] },
                        { test: /\.(png|jpg|gif)$/, use: ['url-loader'] }
                    ]
                }
            }),
            uglify(),
            rename({ suffix: '.min' }),
            gulp.dest('./public/js/')
        ],
        cb
    )
});

gulp.task('watch', ['sass', 'scripts1', 'scripts2'], function() {
    gulp.watch('./resources/assets/sass/**/*.scss', ['sass']);
    gulp.watch('./resources/assets/js/src1/**/*.js', ['scripts1']);
    gulp.watch('./resources/assets/js/src2/**/*.js', ['scripts2']);
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
