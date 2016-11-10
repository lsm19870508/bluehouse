// var elixir = require('laravel-elixir');
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
// elixir(function(mix) {
//     mix.sass('app.scss');
// });
var gulp = require('gulp');
var elixir = require('laravel-elixir');

/**
 * 拷贝任何需要的文件
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfiles", function() {

    gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap"));

    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/dist/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    gulp.src("vendor/bower_dl/font-awesome/less/**")
        .pipe(gulp.dest("resources/assets/less/fontawesome"));

    gulp.src("vendor/bower_dl/font-awesome/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    gulp.src("vendor/bower_dl/Framework7/dist/css/**")
        .pipe(gulp.dest("public/assets/framework7/css"));

    gulp.src("vendor/bower_dl/Framework7/dist/img/**")
        .pipe(gulp.dest("public/assets/framework7/img"));

    gulp.src("vendor/bower_dl/Framework7/dist/js/**")
        .pipe(gulp.dest("public/assets/framework7/js"));
});

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

    // 合并 scripts
    mix.scripts([
            'js/jquery.js',
            'js/bootstrap.js'
        ],
        'public/assets/js/admin.js',
        'resources/assets'
    );

    // 编译 Less
    mix.less('admin.less', 'public/assets/css/admin.css');
});