# Walsh Workspace

Wordpress theme for Walsh Workspace. Based on the RPG Blueprint Theme.

## Prerequisites

The following required Plugins are listed below:

* [ActiveCampaign - Forms, Site Tracking, Live Chat](https://wordpress.org/plugins/activecampaign-subscription-forms/)<br>
Our WordPress plugin makes it easy to insert ActiveCampaign forms into your posts and pages. How to activate and install [view instructions](https://help.activecampaign.com/hc/en-us/articles/222475388-WordPress-plugin)<br>

* [Elfsight Instagram Feed CC](https://elfsight.com/instagram-feed-instashow/).<br> Instagram feed. Requires License

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
projectURL: 'walshworkspace.local',
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

* After pushing from Staging to Production **make sure the Discourage search engines** from indexing this site check box is not checked on production. You can find this setting under WordPress Settings/Reading/Search Engine Visibility.

* The folder **print-server** needs to be added to the root directory of the live website. This code is for their internal print server.

```shell
├── print-server
│   
│
├── walshworkspace.com
```
