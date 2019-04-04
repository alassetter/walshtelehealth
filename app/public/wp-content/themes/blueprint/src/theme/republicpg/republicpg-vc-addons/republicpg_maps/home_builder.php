<?php

return array(
          "name" => __("Home Builder", "js_composer"),
          "base" => "home_builder",
          "icon" => "icon-wpb-home-builder",
          "category" => __('Republicpg Elements', 'js_composer'),
          "description" => __('Add a home builder element', 'js_composer'),
          "params" => array(
             array(
              "type" => "fws_image",
              "heading" => __("Builder Logo", "js_composer"),
              "param_name" => "image_url",
              "value" => "",
              "description" => __("Select SVG Logo from media library.", "js_composer")
            ),
             array(
              "type" => "fws_image",
              "heading" => __("Builder Image", "js_composer"),
              "param_name" => "bio_image_url",
              "value" => "",
               "dependency" => array('element' => "home_builder_style", 'value' => array('bio_fullscreen')),
              "description" => __("<i><strong>Image Size Guidelines</strong></i>  <br/>  <strong>Builder Model Image:</strong> large with a portrait aspect ratio - will be shown at the full screen height at 50% of the page width. <br/> <strong>Builder Logo:</strong> Will display at 500x500 so ensure the image you're uploading is at least that size.", "js_composer")
            ),
            array(
              "type" => "dropdown",
              "heading" => __("Home Builder Stlye", "js_composer"),
              "param_name" => "home_builder_style",
              "value" => array(
                 "Bio Shown Fullscreen Modal" => "bio_fullscreen"
               ),
              'save_always' => true,
              "description" => __("Please select the style you desire for the home builder module.", "js_composer")
            ),
            array(
              "type" => "textfield",
              "heading" => __("Home Builder Name", "js_composer"),
              "param_name" => "name",
              "admin_label" => true,
              "description" => __("Please enter the full corporate name of the home builder.", "js_composer")
            ),

            array(
              "type" => "textarea",
              "heading" => __("Home Builder Marketing Statement", "js_composer"),
              "param_name" => "home_builder_bio",
              "description" => __("Enter the home builder marketing statement.", "js_composer"),
              "dependency" => array('element' => "home_builder_style", 'value' => array('bio_fullscreen'))
            ),
                array(
                    "type" => "textfield",
                    "heading" => __("Home Site Size", "js_composer"),
                    "param_name" => "bldr_home_site_size",
                    "admin_label" => true,
                    "description" => __("Please enter the offered home site (lot) sizes. ex. 60' &  70'", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Home Size Range", "js_composer"),
                    "param_name" => "bldr_home_size_range",
                    "admin_label" => true,
                    "description" => __("Please enter the home size range. ex. 2,000 - 4,000 Sq. Ft.", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Starting Pricing", "js_composer"),
                    "param_name" => "starting_from_price",
                    "admin_label" => true,
                    "description" => __("Please enter the starting from price. ex. From The $400s", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Price Range", "js_composer"),
                    "param_name" => "price_range",
                    "admin_label" => true,
                    "description" => __("Please enter the price range. ex. $300,000 - $800,000 ", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Architectural Styles", "js_composer"),
                    "param_name" => "bldr_arch_styles",
                    "admin_label" => true,
                    "description" => __("Please enter how many different archictectural styles offered. ex. 4 Styles ", "js_composer")
                ),

                array(
                    "type" => "textfield",
                    "heading" => __("Sales Counselor", "js_composer"),
                    "param_name" => "bldr_sales_counselor",
                    "admin_label" => true,
                    "description" => __("Please enter the primary sales counselor's name. ex. Glengarry Glen Ross", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Sales Counselor Email", "js_composer"),
                    "param_name" => "bldr_sales_counselor_email",
                    "admin_label" => true,
                    "description" => __("Please enter the Sales Counselor email address ex. name@domain.com", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Phone", "js_composer"),
                    "param_name" => "bldr_phone",
                    "admin_label" => true,
                    "description" => __("Please enter the phone number ex. (817) 000-0000 ", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Phone Click To Call", "js_composer"),
                    "param_name" => "bldr_phone_link",
                    "admin_label" => true,
                    "description" => __("Enter the phone number with no puncuation or spaces ex. 8170000000", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Model Home Address", "js_composer"),
                    "param_name" => "model_address",
                    "admin_label" => true,
                    "description" => __("Please enter the builders primary model home address. ex. 0000 Street Name", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Model Architectural Style", "js_composer"),
                    "param_name" => "model_arch_style",
                    "admin_label" => true,
                    "description" => __("Please enter the builders primary model homes architecture style. ex. Tudor", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Hours", "js_composer"),
                    "param_name" => "model_hours",
                    "admin_label" => true,
                    "description" => __("Please enter the hours for the builders primary model home. ex M-S: 8:00 am - 6:00 pm", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Hours 2", "js_composer"),
                    "param_name" => "model_hours2",
                    "admin_label" => true,
                    "description" => __("Please additional hours", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Hours 3", "js_composer"),
                    "param_name" => "model_hours3",
                    "admin_label" => true,
                    "description" => __("Please additional hours", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Directions To Model", "js_composer"),
                    "param_name" => "model_directions",
                    "admin_label" => true,
                    "description" => __("Please enter the directions link ex. https://www.google.com/maps/place/13801+Walsh+Ave,+Ft+Worth,+TX+76008", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Schedule A Tour Modal", "js_composer"),
                    "param_name" => "schedule_a_tour",
                    "admin_label" => true,
                    "description" => __("Enter the modal short code. ex. popmake-schedule-a-tour", "js_composer")

            )
          )
        );
