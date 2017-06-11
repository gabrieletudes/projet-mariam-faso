/* gabriel/katbiznis
 *
 * /gulpfile.js - Gulp tasks
 *
 *
 * coded by gabriel!
 *
 * started at 09/02/2017
 */

 var gulp = require( "gulp" ),
     htmlmin = require('gulp-htmlmin'),
     image = require( "gulp-image" ),
     sass = require( "gulp-sass" ),
     autoprefixer = require( "gulp-autoprefixer" ),
     csso = require( "gulp-csso" ),
     //pug = require( "gulp-pug" ),
     browserSync = require("browser-sync").create(),
     babel = require( "gulp-babel" );

// --- Task for browser sync
    gulp.task('serve', ['css'], function() {

        browserSync.init({
            server: "./"
        });

});

// --- Task for images
gulp.task( "images", function(){
    gulp.src( "src/img/**" )
        .pipe( image() )
        .pipe( gulp.dest( "assets/img" ) )
} );
// --- Task for styles
gulp.task( "css", function(){
    gulp.src( "src/sass/**/*.scss" )
        .pipe( sass().on( "error", sass.logError ) )
        .pipe( autoprefixer() )
        .pipe( csso() )
        .pipe( gulp.dest( "assets/css" ) )
        .pipe( browserSync.stream() );
} );
// --- Task for html
gulp.task( "html", function(){
    gulp.src( "src/*.html" )
        .pipe(htmlmin({collapseWhitespace: true}))
        .pipe( gulp.dest( "." ) )
        .pipe( browserSync.stream() );
} );
// --- Task for js
gulp.task( "js", function(){
    gulp.src( "src/js/**/*.js" )
        .pipe( babel() )
        .pipe( gulp.dest( "assets/js" ) );
} );
// --- Watch tasks
gulp.task( "watch", function(){
    gulp.watch( "src/images/**", [ "images" ] );
    gulp.watch( "src/sass/**/*.scss", [ "css" ] );
    gulp.watch( "src/*.html", [ "html" ] );
    gulp.watch( "src/js/**/*.js", [ "js" ] );
});
// --- Aliases
gulp.task( "default", [ "serve","images", "html", "css", "js" ] );
gulp.task( "work", [ "default", "watch" ] );
