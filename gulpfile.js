const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const zip = require('gulp-zip');

const path = {
	src: {
		vendor: 'node_modules/',
		assets: 'resources/assets/',
		images: 'resources/assets/img/',
		styles: 'resources/assets/scss/',
		scripts: 'resources/assets/js/',
		fonts: 'resources/assets/fonts/',
	},
	public: {
		assets: 'public/assets/',
		images: 'public/assets/img/',
		styles: 'public/assets/css/',
		scripts: 'public/assets/js/',
		fonts: 'public/assets/fonts/',
	},
	dist: 'dist/',
};

gulp.task('sass', function () {
	return gulp
		.src([path.src.styles + 'style.scss'])
		.pipe(
			sass({
				outputStyle: 'compressed',
			})
		)
		.pipe(concat('style.css'))
		.pipe(gulp.dest(path.public.styles));
});

gulp.task('js', function () {
	return gulp
		.src([path.src.scripts + 'script.js'])
		.pipe(concat('script.js'))
		.pipe(gulp.dest(path.public.scripts));
});

gulp.task('fonts', function () {
	return gulp.src([path.src.fonts + '*']).pipe(gulp.dest(path.public.fonts));
});

gulp.task('images', function () {
	return gulp
		.src([path.src.images + '*'])
		.pipe(gulp.dest(path.public.images));
});

gulp.task('watch', function () {
	// Compile before setting watcher
	gulp.series(['sass', 'js', 'fonts'])();

	let filter = '*.{css,scss,sass,less,js,png,jpg,jpeg,svg}';
	let glob = [path.src.assets + '**/' + filter];

	gulp.watch(glob, gulp.series(['sass', 'js', 'fonts']));
});

gulp.task(
	'dist',
	gulp.series('sass', 'js', 'fonts', 'images', function () {
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
				{ base: '../' }
			)
			.pipe(zip('hemingway-child.zip'))
			.pipe(gulp.dest(path.dist));
	})
);
