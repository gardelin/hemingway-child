const gulp = require('gulp');
const zip = require('gulp-zip');

const path = {
    dist: 'dist/',
};

gulp.task('dist', function () {
    return gulp
        .src(
            [
                '**/*',
                '!{dist,dist/**}',
                '!{node_modules,node_modules/**}',
                '!{assets,assets/**}',
                '!**/.*',
                '!composer.json',
                '!composer.lock',
                '!gulpfile.js',
                '!INSTALL.md',
                '!package.json',
                '!package-lock.json',
                '!yarn.lock',
                '!@todo',
            ],
            {base: '../'},
        )
        .pipe(zip('hemingway-child.zip'))
        .pipe(gulp.dest(path.dist));
});
