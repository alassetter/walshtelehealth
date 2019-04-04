/**
 * Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 */

module.exports = {

  // Local project URL
	projectURL: 'walshtelehealth.local', // The Local project URL of your already running WordPress site. Could be something like domain.local or localhost:3000 depending upon your local WordPress setup.
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,

  // Set the Global Source Folder.
  src: './src/', // Set the Global Source folder.

  // Set the Global Deploy Destination.
  DeployDestination: './dist/', // Set the Global Deploy Distribution folder.

  // Set the Global Build Distribution Destination folder.
	BuildDestination: './build/', // Path to place the zipped project files for deployment builds.

  themeName: 'blueprint', // do not change.

	// Style options.
	styleSRC: './src/scss/style.scss', // Path to main .scss file.
	styleDestination: './', // Path to place the compiled CSS file. Default set to root folder.
	styleDeployDestination: './dist/', // Path to place the compiled CSS files for deployment builds. Default set to dist/build folder.
	outputStyle: 'compact', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

  // CSS options.
  cssSRC: './src/css/**/*', // Source folder of css
  cssDestination: './css/', // Destination folder of optimized images. Must be different from the cssSRC folder.
  cssDeployDestination: './dist/css/',

  // CSS Config options.
  cssconfigSRC: './src/css-config/**/*', // Source folder of css
  cssconfigDestination: './css/', // Destination folder of optimized images. Must be different from the cssSRC folder.
  cssconfigDeployDestination: './dist/css/',

	// JS Vendor options.
	jsVendorSRC: './src/js/vendors/**/*.js', // Path to JS vendor folder.
	jsVendorDestination: './js/vendors/', // Path to place the compiled JS vendors file.
	jsVendorDeployDestination: './dist/js/vendors/', // Path to place the compiled JS vendors file for deployment builds.
	jsVendorFile: 'vendor', // Compiled JS vendors file name. Default set to vendor i.e. vendor.js.

	// JS Custom options.
	jsCustomSRC: './src/js/custom/*.js', // Path to JS custom scripts folder.
	jsCustomDestination: './js/', // Path to place the compiled JS custom scripts file.
	jsCustomDeployDestination: './dist/js/custom/', // Path to place the compiled JS custom scripts file for deployment builds.
	jsCustomFile: 'custom', // Compiled JS custom file name. Default set to custom i.e. custom.js.

	// Images options.
	imgSRC: './src/images/**/**', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDestination: './img/', // Destination folder of optimized images. Must be different from the imagesSRC folder.
	imgDeployDestination: './dist/img/', // Destination folder for optimized images for the deployment build.

  // Theme PHP Files options.
  themeSRC: './src/theme/**/*', // Source folder of php theme files
  themeDestination: './', // Destination folder root
  themeDeployDestination: './dist/',

  // PHP options.
  phpDeployDestination: './dist/', // Path to place PHP files for deployment builds. Default set to dist/build folder.

  // Theme Include Files.
  includesSRC: './src/includes/**/**',
  includesDestination: './includes/',
  includesDeployDestination: './dist/includes/',

  // Fonts options.
	fontsSRC: './src/fonts/**/*.{eot,svg,ttf,woff,woff2,css}',
	fontsDestination: './fonts/',
  fontsDeployDestination: './dist/fonts/',

  // Static options.
  staticSRC: './src/static/**/**',
  staticDestination: './static/',
  staticDeployDestination: './dist/static/',

  // WooCommerce - **Only If Used
  woocommerceSRC: './src/woocommerce/**/*',
  woocommerceDestination: './woocommerce/',
  woocommerceDeployDestination: './dist/woocommerce/',

	// Watch files paths.
	watchStyles: './src/scss/**/*.scss', // Path to all *.css files
	watchCss: './src/css/**/*.css', // Path to all *.scss files
	watchJsVendor: './src/js/vendors/*.js', // Path to all vendor JS files.
	watchJsCustom: './src/js/custom/*.js', // Path to all custom JS files.
	watchPhp: './**/*.php', // Path to all PHP files.
	watchTheme: './src/theme/**/*.php',
  watchCssConfig: './src/css/**/*.{css,php}',
  watchFonts: './src/fonts/**/**.{eot,svg,ttf,woff,woff2,css}',
  watchStatic: './src/static/**/**',

  // Translation options.
	textDomain: 'BLUEPRINT', // Your textdomain here.
	translationFile: 'BLUEPRINT.pot', // Name of the translation file.
	translationDestination: './languages', // Where to save the translation files.
	packageName: 'BLUEPRINT', // Package name.
	bugReport: 'https://github.com/rpgdallas/blueprint/issues', // Where can users report bugs.
	lastTranslator: 'RPG <tech@republicpropertygroup.com>', // Last translator Email ID.
	team: 'SkyyMedia <tech@republicpropertygroup.com>', // Team's Email ID.


  nanoConfig:[
  'safe:false',
  'autoprefixer: false'
  ],

  mqpackerConfig: [
  'sort: true'
  ],


	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	// The following list is set as per WordPress requirements. Though, Feel free to change.
  autoprefixerOptions: [
    'last 2 version',
    '> 5%',
    'ie >= 11',
    'Firefox ESR',
    'last 1 Android versions',
    'last 1 ChromeAndroid versions',
    'last 2 Chrome versions',
    'last 2 Firefox versions',
    'last 2 Safari versions',
    'last 2 iOS versions',
    'last 2 Edge versions',
    'last 2 Opera versions'
  ],

	BROWSERS_LIST: [
		'last 2 version',
		'> 1%',
		'ie >= 11',
		'last 1 Android versions',
		'last 1 ChromeAndroid versions',
		'last 2 Chrome versions',
		'last 2 Firefox versions',
		'last 2 Safari versions',
		'last 2 iOS versions',
		'last 2 Edge versions',
		'last 2 Opera versions'
	]
};
