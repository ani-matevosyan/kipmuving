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

gulp.task('sass', function(cb){
    pump(
        [
            gulp.src('./resources/assets/sass/**/*.scss'),
            sourcemaps.init(),
            sass({outputStyle: 'compressed'}).on('error', sass.logError),
            autoprefixer({
                browsers: ['last 15 version'],
                cascade: false
            }),
            sourcemaps.write("../maps"),
            gulp.dest('./public/css')
        ],
        cb
    )
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
