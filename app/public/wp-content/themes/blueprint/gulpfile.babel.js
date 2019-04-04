/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. Live reloads browser with BrowserSync.
 *      2. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification, and Merge Media Queries.
 *      3. JS: Concatenates & uglifies Vendor and Custom JS files.
 *      4. Images: Minifies PNG, JPEG, GIF and SVG images.
 *      5. Watches files for changes in CSS or JS.
 *      6. Watches files for changes in PHP.
 *      7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
**/

/**
 * Load Configuration.
 *
 * TODO: Customize your project in the wpgulp.js file.
**/
const config = require( './wpgulp.config.js' );

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
**/
const gulp = require( 'gulp' ); // Gulp of-course.

// CSS related plugins.
const sass = require( 'gulp-sass' ); // Gulp plugin for Sass compilation.
const minifycss = require( 'gulp-uglifycss' ); // Minifies CSS files.
// const autoprefixer = require( 'gulp-autoprefixer' ); // Autoprefixing magic.
// const mmq = require( 'gulp-merge-media-queries' ); // Combine matching media queries into one.
const  postcss = require('gulp-postcss');
const  autoprefixer = require('autoprefixer');
const  cssnano = require('cssnano');
const  mqpacker = require('css-mqpacker');
const sasslint = require('gulp-sass-lint');

// JS related plugins.
const concat = require( 'gulp-concat' ); // Concatenates JS files.
const uglify = require( 'gulp-uglify' ); // Minifies JS files.
const babel = require( 'gulp-babel' ); // Compiles ESNext to browser compatible JS.

// Image related plugins.
const imagemin = require( 'gulp-imagemin' ); // Minify PNG, JPEG, GIF and SVG images with imagemin.

// Utility related plugins.
const rename = require( 'gulp-rename' ); // Renames files E.g. style.css -> style.min.css.
const lineec = require( 'gulp-line-ending-corrector' ); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings).
const filter = require( 'gulp-filter' ); // Enables you to work on a subset of the original files by filtering them using a glob.
const sourcemaps = require( 'gulp-sourcemaps' ); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
const notify = require( 'gulp-notify' ); // Sends message notification to you.
const browserSync = require( 'browser-sync' ).create(); // Reloads browser and injects CSS. Time-saving synchronized browser testing.
const cache = require( 'gulp-cache' ); // Cache files in stream for later use.
const remember = require( 'gulp-remember' ); //  Adds all the files it has ever seen back into the stream.
const plumber = require( 'gulp-plumber' ); // Prevent pipe breaking caused by errors from gulp plugins.
const beep = require( 'beepbeep' ); // Make a beep sound from the console
const gulpif = require( 'gulp-if' ); // Allows conditional logic in Gulp workflows
const clean = require( 'gulp-clean' ); // Easy folder deletion for deployment folder
const del = require('del'); // Easy folder deletion for deployment folder
const zip = require( 'gulp-zip' ); // Allows functionality to zip a directory

// Helper variable for deployment builds
let isDeploying = false;

/**
 * Custom Error Handler.
 *
 * @param Mixed err
**/
const errorHandler = r => {
	notify.onError( '\n\n❌  ===> ERROR: <%= error.message %>\n' )( r );
	beep();

	// this.emit('end');
};

/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 * @link http://www.browsersync.io/docs/options/
 *
 * @param {Mixed} done Done.
**/
const browsersync = done => {
	browserSync.init({
		proxy: config.projectURL,
		open: config.browserAutoOpen,
		injectChanges: config.injectChanges,
		watchEvents: [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ]
	});
	done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = done => {
	browserSync.reload();
	done();
};

// Helper function to clean the Global Deploy Distribution folder
const cleanDeployDeployment = () => {
	return gulp
		.src( config.DeployDestination, { allowEmpty: true })
		.pipe( clean() );
};

// Helper function to clean the Global Build Distribution Destination folder.
const cleanBuildDestination = () => {
	return gulp
		.src( config.BuildDestination, { allowEmpty: true })
		.pipe( clean() );
};

// Helper function to toggle the isDeploying boolean on and off. By default the isDeploying boolean is set to false.
const toggleIsDeploying = done => {
	( isDeploying ) ? isDeploying = false : isDeploying = true;
	done();
};

// Helper function to deploy screenshot.png
const deployScreenshot = () => {
	return gulp
		.src( config.src + '/screenshot.png', {allowEmpty: true})
		.pipe( gulp.dest( config.DeployDestination ) );
};


/**
 * Task: `clean:Dev`.
 *
 * Cleans all the dev files from the root.
 *
 * This task does the following:
 *    1. Cleans the dev files from the root.
 *    2. Omits any build system files and source files.
**/
gulp.task('clean:dev', () => {
  return del([
    './**/*',
    '!./{node_modules,node_modules/**/*}',
    '!./{src,src/**/*}',
    '!./.git',
    '!./.gitignore',
    '!./.svn',
    '!./gulpfile.babel.js',
    '!./wpgulp.config.js',
    '!./.eslintrc.js',
    '!./.eslintignore',
    '!./.editorconfig',
    '!./phpcs.xml.dist',
    '!./vscode',
    '!./static/**/*',
    '!./package.json',
    '!./package-lock.json'
  ]);
});

/**
 * Task: `clean:dist`.
 *
 * Cleans the Global Deploy Distribution folder.
 *
 * This task does the following:
 *    1. Deletes the folder "./dist" and all files inside it.
 *    2. This is a standalone task
**/
gulp.task('clean:dist', () => {
    return gulp.src( config.DeployDestination, {read: false})
        .pipe(clean());
});

/**
 * Task: `clean:build`.
 *
 * Cleans the Global Build Distribution Destination folder.
 *
 * This task does the following:
 *    1. Deletes the folder "./build" and zip folder inside.
 *    2. This is a standalone task
**/
gulp.task('clean:build', () => {
    return gulp.src( config.BuildDestination, {read: false})
        .pipe(clean());
});

/**
 * Task: `clean:styles`.
 *
 * Cleans the Styles folder.
 *
**/
gulp.task('clean:styles',() => {
  return del(['style.css', 'style.min.css'])
});


/**
 * Task: `scss`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Checks if you are deploying
 *    6. Renames the CSS file with suffix .min.css
 *    7. Minifies the CSS file and generates style.min.css
 *    8. Injects CSS or reloads the browser via browserSync
**/
gulp.task( 'scss', () => {
	return gulp
		.src( config.styleSRC, { allowEmpty: true })

		.pipe( sourcemaps.init() )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
    // Use postcss with autoprefixer and compress the compiled file using cssnano
    .pipe(postcss([
      autoprefixer( config.autoprefixerOptions ),
      mqpacker( config.mqpackerConfig ),
      cssnano( config.nanoConfig )
    ]))

		.pipe( sourcemaps.write( './' ) )

		.pipe(
			gulpif( // if not deploying, write file to the root directory
				! isDeploying,
				gulp.dest( config.styleDestination )
			)
		)
		.pipe( filter( '**/*.css' ) ) // this prevents livereload from reloading the whole page because of the sourcemaps @see: https://stackoverflow.com/questions/34273127/gulp-livereload-reloads-the-entire-page-when-only-css-has-changed
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.

		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the root directory
				isDeploying,
				gulp.dest( config.styleDeployDestination ),
				gulp.dest( config.styleDestination )
			)
		)
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.min.css if that is enqueued.
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> STYLES — completed!\n', onLast: true }) );
});

/**
 * Task: `styles`.
 *
 * Runs the task 'clean:styles' and 'scss' in a series .
 *
**/
gulp.task('styles', gulp.series('clean:styles', 'scss'));

/**
 * Run Sass through a linter.
**/
 gulp.task( 'sasslint', () => {
   return gulp
   .src( config.styleSRC, { allowEmpty: true })
 // .src([
 //  config.style2SRC,,
 //  '!assets/sass/base/_normalize.scss',
 //  '!assets/sass/utilities/animate/**/*.*',
 //  '!assets/sass/base/_sprites.scss'
 // ])
 .pipe(sasslint())
 .pipe(sasslint.format())
 .pipe(sasslint.failOnError());
});

/**
 * Task: `css`.
 *
 * Compiles CSS, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source css file
 *    2. Writes Sourcemaps for it
 *    3. Autoprefixes it and generates style.css
 *    4. Checks if you are deploying
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 *    Need to Concatenate but this will require reworking theme files, cache busting and adding rev manifest https://www.npmjs.com/package/gulp-concat-css
**/
gulp.task( 'css', () => {
	return gulp
		.src( config.cssSRC, { allowEmpty: true })
		.pipe( sourcemaps.init() )
		.pipe( sourcemaps.write({ includeContent: false }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		// .pipe( autoprefixer( config.BROWSERS_LIST ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( sourcemaps.write( './' ) )
    .pipe(
			gulpif( // if not deploying, write file to the root directory
				! isDeploying,
				gulp.dest( config.cssDestination )
			)
		)
    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		// .pipe( mmq({ log: true }) ) // Merge Media Queries only for .min.css version.
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
    .pipe( minifycss({ maxLineLen: 10 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe(
      gulpif( // if you are deploying, write to the deployment directory
       isDeploying,
        gulp.dest( config.cssDeployDestination ),
        gulp.dest( config.cssDestination )
      )
    )
		.pipe( filter( '***/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.min.css if that is enqueued.
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> CSS — completed!\n', onLast: true }) );
});

/**
 * Task: `vendorsJS`.
 *
 * Concatenate and uglify vendor JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS vendor files
 *     2. Concatenates all the files and generates vendors.js
 *     3. Check if you are deploying
 *     4. Renames the JS file with suffix .min.js
 *     5. Uglifes/Minifies the JS file and generates vendors.min.js
**/
gulp.task( 'vendorsJS', () => {
	return gulp
		.src( config.jsVendorSRC, { since: gulp.lastRun( 'vendorsJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		// .pipe(
		// 	babel({
		// 		presets: [
		// 			[
		// 				'@babel/preset-env', // Preset to compile your modern JS to ES5.
		// 				{
		// 					targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
		// 				}
		// 			]
		// 		]
		// 	})
		// )
		.pipe( remember( config.jsVendorSRC ) ) // Bring all files back to stream.
		// .pipe( concat( config.jsVendorFile + '.js' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			gulpif( // if not deploying, write file to the assets/js directory
				! isDeploying,
				gulp.dest( config.jsVendorDestination )
			)
		)
		.pipe(
			gulpif(
				! isDeploying, // if not deploying, rename the file name
				rename({
					basename: config.jsVendorFile,
					suffix: '.min'
				})
			)
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.jsVendorDeployDestination ),
				gulp.dest( config.jsVendorDestination )
			)
		)
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> VENDOR JS — completed!\n', onLast: true }) );
});

/**
 * Task: `customJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Checks if you are deploying
 *     4. Renames the JS file with suffix .min.js
 *     5. Uglifes/Minifies the JS file and generates custom.min.js
**/
gulp.task( 'customJS', () => {
	return gulp
		.src( config.jsCustomSRC, { since: gulp.lastRun( 'customJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsCustomSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsCustomFile + '.js' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			gulpif( // if not deploying, write file to the assets/js directory
				! isDeploying,
				gulp.dest( config.jsCustomDestination )
			)
		)
		.pipe(
			gulpif ( // if not deploying, rename the file name
				! isDeploying,
				rename({
					basename: config.jsCustomFile,
					suffix: '.min'
				})
			)
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.jsCustomDeployDestination ),
				gulp.dest( config.jsCustomDestination )
			)
		)
		.pipe( notify({ message: '\n\n✅  ===> CUSTOM JS — completed!\n', onLast: true }) );
});

/**
 * Task: `images`.
 *
 * Minifies PNG, JPEG, GIF and SVG images.
 *
 * This task does the following:
 *     1. Gets the source of images raw folder
 *     2. Minifies PNG, JPEG, GIF and SVG images
 *     3. Checks if you are deploying
 *     4. Generates and saves the optimized images
 *
 * This task will run only once, if you want to run it
 * again, do it with the command `gulp images`.
 *
 * Read the following to change these options.
 * @link https://github.com/sindresorhus/gulp-imagemin
**/
gulp.task( 'images', () => {
	return gulp
		.src( config.imgSRC )
		.pipe(
			cache(
				imagemin([
					imagemin.gifsicle({ interlaced: true }),
					imagemin.jpegtran({ progressive: true }),
					imagemin.optipng({ optimizationLevel: 3 }), // 0-7 low-high.
					imagemin.svgo({
						plugins: [ { removeViewBox: true }, { cleanupIDs: false } ]
					})
				])
			)
		)
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.imgDeployDestination ),
				gulp.dest( config.imgDestination )
			)
		)
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> IMAGES — completed!\n', onLast: true }) );
});

/**
 * Task: `clear-images-cache`.
 *
 * Deletes the images cache. By running the next "images" task,
 * each image will be regenerated.
**/
gulp.task( 'clearCache', function( done ) {
	return cache.clearAll( done );
});

/**
 * Task: `theme`.
 *
 * Copies over all PHP theme related files
**/
gulp.task( 'theme', () => {
	return gulp
		.src( config.themeSRC )
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.themeDeployDestination ),
				gulp.dest( config.themeDestination )
			)
		)
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> THEME — completed!\n', onLast: true }) );
});

/**
 * Task: `css-config`.
 *
 * Copies over all PHP theme related files
**/
gulp.task( 'css-config', () => {
	return gulp
		.src( config.cssconfigSRC )
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.cssconfigDeployDestination ),
				gulp.dest( config.cssconfigDestination)
			)
		)
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> CSS CONFIG — completed!\n', onLast: true }) );
});

/**
 * Task: `fonts`.
 *
 * Copies over all font files.
**/
gulp.task( 'fonts', () => {
	return gulp
		.src( config.fontsSRC )
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.fontsDeployDestination ),
				gulp.dest( config.fontsDestination)
			)
		)
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> FONTS — completed!\n', onLast: true }) );
});

/**
 * Task: `static`.
 *
 * Copies over all static files. Used for map component
**/
gulp.task( 'static', () => {
	return gulp
    .src( config.staticSRC, { allowEmpty: true })
		.pipe(
			gulpif( // if you are deploying, write to the deployment directory, else write to the assets directory
				isDeploying,
				gulp.dest( config.staticDeployDestination ),
				gulp.dest( config.staticDestination )
			)
		)
		.pipe( notify({ sound: "Beep", message: '\n\n✅  ===> STATIC — completed!\n', onLast: true }) );
});

// /**
//  * Task: `deployPHP`.
//  *
//  * Copy PHP files from development directory into the deployment directory
//  *
//  * This task does the following:
//  *     1. Gets the source folder for PHP files
//  *     2. Copies PHP files into the folder specified in phpDeployDestination
// **/
// gulp.task( 'deployPHP', () => {
// 	return gulp
// 		.src( config.watchPhp )
// 		.pipe( gulp.dest( config.phpDeployDestination ) );
// });


/**
 * ZIP Tasks.
 * Task: `zip`.
 *
 * 1. Zip the production files up for deployment
 * 2. Rename the folder to your Theme Name set at the beginning of the gulp file.
**/
gulp.task( 'zip', () => {
	return gulp
		.src( config.DeployDestination + '/**' )
		.pipe( zip( config.themeName + '.zip' ) )
		.pipe( gulp.dest( config.BuildDestination ) )
		.pipe( notify({ sound: 'Beep', message: '\n\n✅  ===> ZIP PROJECT — completed!\n', onLast: true }) );
});

/**
 * Task: `deploy`.
 *
 * Processes source files in project into a distribution ready for deployment
 *
 * This task does the following:
 *     1. Sets the isDeveloping boolean to true for task runners to know where to write
 *     2. Builds CSS files in deployment directory
 *     3. Builds vendor JS files in deploy directory
 *     4. Builds custom JS files in deploy directory
 *     5. Optimizes images and places them deploy directory
 *     6. Loads all PHP files in the project into the deploy directory
 *     7. Sets the isDeveloping boolean back to false
**/
gulp.task(
  'deploy',
	gulp.series (
    cleanDeployDeployment,
		cleanBuildDestination,
		toggleIsDeploying, // this toggles the variable isDeploying which starts at false. Since we are deploying, set to true.
		'styles',
    'css',
    'vendorsJS',
    'customJS',
    'images',
    'theme',
    'css-config',
    'fonts',
    'static',
    // 'deployPHP',
    deployScreenshot, 'zip',
		toggleIsDeploying // we have finished deploying our code to deployment folder, set isDeploying back to false.
	)
);

/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks. And Reloads on file change
**/
gulp.task(
	'default',
	gulp.parallel(
    'styles',
    'css',
    'vendorsJS',
    'customJS',
    'images',
    'theme',
    'css-config',
    'fonts',
    'static',
    browsersync, () => {
		gulp.watch( config.watchPhp, reload );
		gulp.watch( config.watchStyles, gulp.parallel( 'styles' ) );
    gulp.watch( config.watchCss, gulp.parallel( 'css' ) );
		gulp.watch( config.watchJsVendor, gulp.series( 'vendorsJS', reload ) );
		gulp.watch( config.watchJsCustom, gulp.series( 'customJS', reload ) );
		gulp.watch( config.imgSRC, gulp.series( 'images', reload ) );
    gulp.watch( config.watchTheme, gulp.series( 'theme', reload ) );
    gulp.watch( config.watchCssConfig, gulp.parallel( 'css-config' ) );
    gulp.watch( config.watchFonts, gulp.parallel( 'fonts' ) );
    gulp.watch( config.watchStatic, gulp.parallel( 'static' ) );
	})
);
