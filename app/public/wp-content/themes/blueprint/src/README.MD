# Blueprint

## STATUS
Working to remove unused code, clean up and streamline. Unfortunately was not able to finish. Hopefully the following helps as well.

## DOCUMENTATION
Build and Developement documentation can be found [here](https://github.com/rpgdallas/RPG-WpGulpBuild)

## ADDING CUSTOM FONTS
Working to remove unused code and streamline.  

If you want to add additional fonts to the visual builder. Add them to src/theme/republicpg/helpers/custom-fonts.php

EXAMPLE:
```
function blueprint_redux_custom_fonts( $custom_fonts ) {
    return array(
        'Custom Fonts' => array(
          'Simplifica, sans-serif' => "Simplifica",
					'HelveticaNeueLT-LightCond, Helvetica, Arial, Roboto, sans-serif' => "HelveticaNeueLT-LightCond",
					'HelveticaNeueLT-MediumCond", Helvetica, Arial, Roboto, sans-serif' => "HelveticaNeueLT-MediumCond"
        )
    );
}
```

Variables: Src/scss/variables/fonts.scss
Styles src/scss/fonts/fonts.scss


## CONTACT FORMS

Add the Active Campaign API Key

[Directions](https://help.activecampaign.com/hc/en-us/articles/207317590-Getting-started-with-the-API)

You will then need to go to the plugin settings and activate the Walsh Workspace Contact Form. (Do Not include CSS - There is a checkbox below the activation)

You will then need to copy they form id and add it to the page where the form is.


## ACTIVATE YOAST AND ADD LICENSE KEY

1. Go here and login is RPG. The domain should already be there. Make sure it is active. https://yoast.com/
2. Download the premium plugin and replace the one currently installed.
3. Open the Configuration Wizard and add the following

 *Environment:*
	*X* Option A: My site is live and ready to be indexed

*Site Type:*
    *X* A small offline business

*Company Or Person*
    *X* Company

*Name of the Company:*
    Walsh Workspace

*Upload Walsh Workspace Logo*

*Social Profiles:*
    Add the following in the respective field.
    https://facebook.com/walshworkspace
    https://instagram.com/walshworkspace

*Post Type Visibility*

*The post type "Posts" should be*
    *X* Visible

*The post type “Pages” should be*
    *X* Visible

*The post type “Media” should be*
    *X* Visible

*The post type “Portfolio” should be*
      *X* Hidden - (Not In Use)

4. *Activate the Search Console/Webmaster Tools*
You can try and add this code to the form field labeled “Google Search Console”  google265c8400f9bd26b0
If that does not work. Re authenicate with Godaddy or Google.

** For this your will need the login for Godaddy and The RPG Google Account. rpgteam@gmail.com (cant remember if this is the exact email address but it is close to this and in one password.)

Google has been updating this. But make sure both domains are added.
Walshworkspace.com and www.walshworkspace.com
The www version is technically a subdomain.


## ONCE DEPLOYED TO PRODUCTION

1. Once you push to production MAKE SURE that under the Wordpress Settings/Reading/Search Engine Visibility - The checkbox should be UNCHECKED. Otherwise the website will be hidden from the Google Index.
2. I would also deactivate  and delete:
 	*WP Migrate DB Pro Media Files*
	*WP Migrate DB Pro*
3. I would also login to Google Analytics and check to be sure visits are being logged.
4. Check the contact form.
5. About a week later login and check google search console. Make corrections accordingly.
6. Clean All Caches.
