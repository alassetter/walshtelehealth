# Walsh Workspace

Wordpress theme for Walsh Workspace. Based on the RPG Blueprint Theme.

## Site Notes

This site should be hidden from the search index. Please make sure the check box is checked under WordPress/Settings/Reading/Search Engine Visability

X Discourage search engines from indexing this site

### FONTS

#### Domaine Display Medium - Stored in

```
src/fonts/DomaineDisplay
```


#### Museo-sans - Adobe Type Kit Font

If you do not do this the fonts will stop working after a month or so. Because it is currently tied to my account and I will remove it. So you need to swap it out with your Adobe Typekit API Key.

Login in with SFTP and edit the following file.

```
app/public/wp-content/themes/blueprint/src/theme/header.php

```

Edit line #29

```
<link rel="stylesheet" href="https://use.typekit.net/xog6foy.css">
```
You need to replace 'xog6foy.css' with the Republic Property Group Adobe Typekit API key. It think it is 'kzf3fwy.css'.



## Prerequisites

The following required Plugins are listed below:

* [Classic Editor](https://wordpress.org/plugins/classic-editor/).<br>
This plugin hides all functionality available in the new Block Editor (“Gutenberg”) so that the Page Builder is compatible. Go to settings and make sure Default editor for all users is set to "Classic Editor"

* [WP Media folder](https://www.joomunited.com/).<br> Media manager with folders for image/media organization. License required.

* [WP Migrate DB Pro](https://deliciousbrains.com/wp-migrate-db-pro/).<br>
Used to deploy/push local theme files to WP Engine. How to activate the required license [instructions](https://deliciousbrains.com/wp-migrate-db-pro/doc/activating-license/). User Guide can be found here: [view instructions](https://deliciousbrains.com/wp-migrate-db-pro/docs/getting-started/).<br>

* [WP Migrate DB Pro Media Files](https://deliciousbrains.com/wp-migrate-db-pro/).<br> Used for syncing local media files with WP Engine.

* [Yoast SEO Premium](https://yoast.com).<br>
Used for Search Engine Optimization.

* [Blueprint WPBakery Page Builder](https://wpbakery.com/).<br>
Heavily customized but you can find the documentation on their website. Once activated please go to WPBakery Page Builder settings, under the General Tab. Find the Disable Gutenberg Editor and check the box Disable.

```
Remember you can compare all of the following plugin settings by comparing the settings from the live site.
```
<br>

## Installing The Theme

Please do not change the name of the theme. It will cause issues.

### STEP #1
Setup your local environment and install WordPress.

### STEP #2
Download or Clone this repo into your local Wordpress Install.

Depending on how you have your local environment setup you may need to download and copy over the theme folder "blueprint" into your local themes folder.

The current structure is for Local by Flywheel. You can find additional documentation on the Gulp Build Workflow

Your directory should look like this:

<br>

```shell
├── README.md
├── composer.json
├── gulpfile.babel.js
├── package.json
├── .editorconfig
├── .eslintignore
├── .eslintrc.js
├── .gitignore
├── wpgulp.config.js
└── src
│   
│
├── blueprint
```

[View Documentation on RPG WP Gulp Build Workflow](https://github.com/rpgdallas/RPG-WpGulpBuild/).


### STEP #3

In the terminal go to the /walshworkspace.local/wp-content/themes/blueprint theme folder and run the following command

```
npm install
```

### STEP #4
Open the wpgulp.config.js and make sure the projectURL is set accordingly

```
projectURL: 'walshtelehealth.local',
```

### STEP #5
Double check that all other paths are correctly set in wpgulp.config.js

### STEP #6
In the wpgulp.config.js file make sure the theme name is set to blueprint.

```
themeName: 'blueprint', // do not change.
```

### STEP #7
1. In terminal navigate to the theme directory 'blueprint'
2. Now run the following default command.

```
gulp
```

Now you should be able to active the the theme and you can make SCSS and Javascript changes to the theme.

## Deploying The Theme

The following task will build and deploy all the required theme files within the dist folder. It uses these files to create a deployable zipped theme file named 'blueprint.zip' and places it inside the build folder.

1. In terminal go the the 'blueprint' folder inside your themes folder.
2. Run the following default command.

```
gulp deploy
```
Now, Take the zipped theme file and upload to WP Engine. I use WP Migrate DB Pro to help keep my local files in sync with the staging site. You can push and pull files to WP Engine. But in order to get the theme folder synced up. I login and upload the compiled zip file from the Build folder.

Afterwards make sure you clean the WP Engine Cache.

[View Documentation on RPG WP Gulp Build Workflow](https://github.com/rpgdallas/RPG-WpGulpBuild/).

<br>

## Other Notes

NOTES:

This site does not require much functionality. In the future if you are adding elements to the site. You will need to style sheets as that functionality is needed. You will need to do this before using elements in visual builder.

By enabling the style scss stylesheets there will be basic styles. But the styles will not match the current brand style in come cases.  So you will need to style and adjust them accordingly.


You can enable them by uncommenting them in the following locations:
src/scss

**SCSS Directory Location**

```
src/scss/style.scss
```

Below are the styles that are disabled by commenting them out. “//“ To make them active again simply remove the “//“ with in the appropriate file.


**Animation**
```
src/scss/animation/__animation-dir.scss
```

**Blog**
```
src/scss /blog/__blog.scss
// @import "blog-and-pagination";
// @import "love";
```

**Comments Styles**
```
src/scss/comment/__comment-dir.scss
// @import "comments";
```

**Find A Home**
```
src/scss /find-a-home/__find-a-home.scss
// @import "find-a-home-map";
```

**Fonts**
```
src/scss/fonts/__fonts-dir.scss
// @import "typekit";
@import "fonts";
@import "font-icomoon";
@import "font-linecons";
@import "font-steadysets";
```

**Footer**
```
src/scss/footer/__footer-dir.scss
// @import "footer-elements";
```

**Forms**
```
src/scss/forms/__forms-dir.scss
@import "general-forms";
@import "minimal-forms";
@import "selects";
@import "tables";
@import "minimal-icons";
```

**Global**
```
src/scss/global/__global-dir.scss
@import "global";
@import "type";
```

**Header**
```
src/scss/header/__header-dir.scss
@import "header";
```

**Main**
```
src/scss/main-content/__main-content-dir.scss
```

**Mixins**
```
src/scss/mixins/__mixins-dir.scss
@import "fluid-type";
@import "font-family"; // @include din-2014-300;
@import "font-weight"; // @include font-weight(100);
@import "color-modifiers";
@import "transition"; // @include transition(opacity .45s cubic-bezier(0.25,1,0.33,1));
@import "font-smoothing"; // @include fontSmoothing();
@import "spacer"; // @include fontSmoothing();
@import "mq";
@import "link-styles";
```

**Page**
```
src/scss/page/__page-dir.scss
@import "page-header";
@import "single";
@import "page-header-bg";
// @import "social-sharing-fixed";
// @import "particle-style";
// @import "pagination-navigation";
// @import "header-text-effects";
@import "scroll-down";
@import "full-screen-header";
// @import "sharing";
@import "section-down";
// @import "blog-port-next-prev";
@import "scroll-to-top";
// @import "social-sharing";
// @import "single-proj-port";
// @import "portfolio";
// @import "team-member";
// @import "fancy-box";
// @import "flip-box";
// @import "category-grid";
// @import "contact";
// @import "google-map";
@import "masonry-items";
@import "post-area";
```

**Plugin Related**
```
src/scss /plugin-related/__plugin-related-dir.scss
@import "superfish";
@import "mejs";
@import "header-outer";
// @import "tilt-button";
@import "transparent-header";
// @import "flickity";
// @import "popular-posts";
// @import "parallax-image-grid";
// @import "sticky-submenu";
// @import "food-menu-items";
// @import "video-light-box";
// @import "image-hotspots";
@import "video-bg";
// @import "mouse-parallax";
// @import "flexslider";
@import "media-element-styles";
@import "isotope";
// @import "carouFredSel";
// @import "carousel";
// @import "blog-recent";
// @import "owl-carousel";
@import "scrollbar";
```

**Shortcode**
```
src/scss /shortcode/__shortcode.scss
@import "icons";
@import "animated-title";
// @import "milestone";
// @import "cta";
@import "horizontal-list";
@import "fancy-ul";
@import "icon-list";
// @import "morphing-outline";
// @import "split-heading";
// @import "highlighted-text";
// @import "bar-graph";
// @import "testimonial-slider";
@import "tabbed";
@import "image-with-animation";
@import "cascading-images";
@import "toggle";
@import "full-width-section";
// @import "shape-divider";
// @import "clients";
// @import "pricing-tables";
@import "footer-styles";
@import "slide-out-widget";
// @import "flickr-widget";
// @import "calendar-widget";
// @import "search-widget";
@import "footer-widgets";
// @import "call-to-action";
```

**Side Bar**
```
src/scss/sidebar/__sidebar-dir.scss
// @import "sidebar.scss";
```
**Style-guide**
```
src/scss /style-guide/__style-guide.scss
// @import "table";
// @import "color-swatches";
// @import "shadow-type";
// @import "spacing-scales";
```

**Telehealth**
```
src/scss/telehealth/__telehealth.scss
```

**Theme Base Styles**
```
src/scss/theme-base/__theme-base-dir.scss
@import "browser";
@import "colors";
@import "utility";
// @import "blockquote";
// @import "code";
@import "lists";
@import "font-weight";
// @import "notice-banner";
// @import "tag";
@import "text-modifiers";
// @import "width";
@import "utility";
// @import "spacing";
// @import "shadows";
```

**Variables**
```
src/scss/variables/__variables.scss
@import "colors";
@import "color-map";
@import "fonts";
@import "forms";
@import "spacing";
// @import "widths";
```
