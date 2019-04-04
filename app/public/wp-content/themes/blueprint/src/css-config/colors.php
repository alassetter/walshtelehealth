<?php

$options = get_republicpg_theme_options();
$external_dynamic = (!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1) ? 'on' : 'off';

	$options = get_republicpg_theme_options();

	if($external_dynamic != 'on') { ob_start(); }

	$social_accent_color = (!empty($options["sharing_btn_accent_color"]) && $options["sharing_btn_accent_color"] == '1') ? 'body .twitter-share:hover i, .twitter-share.hovered i, body .linkedin-share:hover i, .linkedin-share.hovered i, body .google-plus-share:hover i, .google-plus-share.hovered i, .pinterest-share:hover i, .pinterest-share.hovered i, .facebook-share:hover i, .facebook-share.hovered i,' : null;
	$social_accent_color_rounded = (!empty($options["sharing_btn_accent_color"]) && $options["sharing_btn_accent_color"] == '1') ? 'body[data-button-style="rounded"] .wpb_wrapper .twitter-share:before, body[data-button-style="rounded"] .wpb_wrapper .twitter-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .facebook-share:before, body[data-button-style="rounded"] .wpb_wrapper .facebook-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .google-plus-share:before, body[data-button-style="rounded"] .wpb_wrapper .google-plus-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .republicpg-social:hover > *:before, body[data-button-style="rounded"] .wpb_wrapper .pinterest-share:before, body[data-button-style="rounded"] .wpb_wrapper .pinterest-share.hovered:before, body[data-button-style="rounded"] .wpb_wrapper .linkedin-share:before, body[data-button-style="rounded"] .wpb_wrapper .linkedin-share.hovered:before, ' : null;
	global $woocommerce;
	if ($woocommerce) {
		$woocommerce_main = ', .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce .product-wrap .add_to_cart_button.added, .single-product .facebook-share a:hover, .single-product .twitter-share a:hover, .single-product .pinterest-share a:hover, .woocommerce-message, .woocommerce-error, .woocommerce-info, .woocommerce .chzn-container .chzn-results .highlighted, .woocommerce .chosen-container .chosen-results .highlighted, .woocommerce a.button:hover, .woocommerce-page a.button:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce-page #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .ascend.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .ascend.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, html .woocommerce #sidebar div ul li a:hover ~ .count, html .woocommerce #sidebar div ul li.current-cat > .count, body[data-fancy-form-rcs="1"] .select2-container--default .select2-selection--single:hover, body[data-fancy-form-rcs="1"] .select2-container--default.select2-container--open .select2-selection--single, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .material.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-account .woocommerce-form-login button.button, .woocommerce-account .woocommerce-form-register button.button, .woocommerce.widget_price_filter .price_slider:not(.ui-slider):before, .woocommerce.widget_price_filter .price_slider:not(.ui-slider):after , .woocommerce.widget_price_filter .price_slider:not(.ui-slider), body .woocommerce.add_to_cart_inline a.button.add_to_cart_button, .woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover, .woocommerce-page .woocommerce p.return-to-shop a.wc-backward, .woocommerce .yith-wcan-reset-navigation.button ';
	} else {
		$woocommerce_main = null;
	}

	if($external_dynamic != 'on') { echo '<style type="text/css">'; }

	echo 'body a { color: '.$options["accent-color"].'; }

	#header-outer:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, header#top nav > ul > li.button_bordered > a:hover, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current-menu-item > a,
	header#top nav .sf-menu li.current_page_item > a .sf-sub-indicator i, header#top nav .sf-menu li.current_page_ancestor > a .sf-sub-indicator i,
	#header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current_page_ancestor > a, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current-menu-ancestor > a, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.current_page_item > a,
	body header#top nav .sf-menu li.current_page_item > a .sf-sub-indicator [class^="icon-"], header#top nav .sf-menu li.current_page_ancestor > a .sf-sub-indicator [class^="icon-"],
    .sf-menu li ul li.sfHover > a .sf-sub-indicator [class^="icon-"], #header-outer:not(.transparent) #social-in-menu a i:after, .testimonial_slider[data-rating-color="accent-color"] .star-rating .filled:before,
	ul.sf-menu > li > a:hover > .sf-sub-indicator i, ul.sf-menu > li > a:active > .sf-sub-indicator i, ul.sf-menu > li.sfHover > a > .sf-sub-indicator i,
	.sf-menu ul li.current_page_item > a , .sf-menu ul li.current-menu-ancestor > a, .sf-menu ul li.current_page_ancestor > a, .sf-menu ul a:focus ,
	.sf-menu ul a:hover, .sf-menu ul a:active, .sf-menu ul li:hover > a, .sf-menu ul li.sfHover > a, .sf-menu li ul li a:hover, .sf-menu li ul li.sfHover > a,
	#footer-outer a:hover, .recent-posts .post-header a:hover, article.post .post-header a:hover, article.result a:hover,  article.post .post-header h2 a, .single article.post .post-meta a:hover,
	.comment-list .comment-meta a:hover, label span, .wpcf7-form p span, .icon-3x[class^="icon-"], .icon-3x[class*=" icon-"], .icon-tiny[class^="icon-"], body .circle-border, article.result .title a, .home .blog-recent:not([data-style="list_featured_first_row"]) .col .post-header a:hover,
	.home .blog-recent .col .post-header h3 a, #single-below-header a:hover, header#top #logo:hover, .sf-menu > li.current_page_ancestor > a > .sf-sub-indicator [class^="icon-"], .sf-menu > li.current-menu-ancestor > a > .sf-sub-indicator [class^="icon-"],
	body #mobile-menu li.open > a [class^="icon-"], .pricing-column h3, .pricing-table[data-style="flat-alternative"] .pricing-column.accent-color h4, .pricing-table[data-style="flat-alternative"] .pricing-column.accent-color .interval,
	.comment-author a:hover, .project-attrs li i, #footer-outer #copyright li a i:hover, .col:hover > [class^="icon-"].icon-3x.accent-color.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.accent-color.alt-style.hovered,
	#header-outer .widget_shopping_cart .cart_list a, .woocommerce .star-rating, .woocommerce form .form-row .required, .woocommerce-page form .form-row .required, body #header-secondary-outer #social a:hover i,
	.woocommerce ul.products li.product .price, '.$social_accent_color.' .woocommerce-page ul.products li.product .price, .republicpg-milestone .number.accent-color, header#top nav > ul > li.megamenu > ul > li > a:hover, header#top nav > ul > li.megamenu > ul > li.sfHover > a, body #portfolio-nav a:hover i,
	span.accent-color, .republicpg-love:hover i, .republicpg-love.loved i, .portfolio-items .republicpg-love:hover i, .portfolio-items .republicpg-love.loved i, body .hovered .republicpg-love i, header#top nav ul #republicpg-user-account a:hover span, header#top nav ul #search-btn a:hover span, header#top nav ul .slide-out-widget-area-toggle a:hover span, body:not(.material) #search-outer #search #close a span:hover,
	.carousel-wrap[data-full-width="true"] .carousel-heading a:hover i, #search-outer .ui-widget-content li:hover a .title,  #search-outer .ui-widget-content .ui-state-hover .title,  #search-outer .ui-widget-content .ui-state-focus .title, .portfolio-filters-inline .container ul li a.active,
	body [class^="icon-"].icon-default-style,.single-post #single-below-header.fullscreen-header .icon-blueprint-heart-2, .svg-icon-holder[data-color="accent-color"], .team-member a.accent-color:hover, .ascend .comment-list .reply a, .wpcf7-form .wpcf7-not-valid-tip, .text_on_hover.product .add_to_cart_button, .blog-recent[data-style="minimal"] .col > span, .blog-recent[data-style="title_only"] .col:hover .post-header .title, .woocommerce-checkout-review-order-table .product-info .amount,
	.tabbed[data-style="minimal"] > ul li a.active-tab, .masonry.classic_enhanced  article.post .post-meta a:hover i, .blog-recent[data-style*="classic_enhanced"] .post-meta a:hover i, .blog-recent[data-style*="classic_enhanced"] .post-meta .icon-blueprint-heart-2.loved, .masonry.classic_enhanced article.post .post-meta .icon-blueprint-heart-2.loved, .single #single-meta ul li:not(.meta-share-count):hover i, .single #single-meta ul li:not(.meta-share-count):hover a, .single #single-meta ul li:not(.meta-share-count):hover span, .single #single-meta ul li.meta-share-count .republicpg-social a:hover i, #project-meta  #single-meta ul li > a, #project-meta ul li.meta-share-count .republicpg-social a:hover i,  #project-meta ul li:not(.meta-share-count):hover i, #project-meta ul li:not(.meta-share-count):hover span,.republicpg-icon-list[data-icon-style="border"][data-icon-color="accent-color"] .list-icon-holder[data-icon_type="numerical"] span, .republicpg-icon-list[data-icon-color="accent-color"][data-icon-style="border"] .content h4, body[data-dropdown-style="minimal"] #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, body[data-dropdown-style="minimal"] #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, .post-area.standard-minimal article.post .post-meta .date a,  .post-area.standard-minimal article.post .post-header h2 a:hover, .post-area.standard-minimal  article.post .more-link:hover span,
	 .post-area.standard-minimal article.post .more-link span:after, .post-area.standard-minimal article.post .minimal-post-meta a:hover, body #pagination .page-numbers.prev:hover, body #pagination .page-numbers.next:hover,  html body .woocommerce-pagination a.page-numbers:hover, body .woocommerce-pagination a.page-numbers:hover, body #pagination a.page-numbers:hover, .republicpg-slide-in-cart .widget_shopping_cart .cart_list a, .sf-menu ul li.open-submenu > a,
	.woocommerce p.stars a:hover, .woocommerce .material.product .product-wrap .product-add-to-cart a:hover, .woocommerce .material.product .product-wrap .product-add-to-cart a:hover > span, .woocommerce-MyAccount-navigation ul li.is-active a:before, .woocommerce-MyAccount-navigation ul li:hover a:before, .woocommerce.ascend .price_slider_amount button.button[type="submit"], html .ascend.woocommerce #sidebar div ul li a:hover, html .ascend.woocommerce #sidebar div ul li.current-cat > a, .woocommerce .widget_layered_nav ul li.chosen a:after, .woocommerce-page .widget_layered_nav ul li.chosen a:after, [data-style="list_featured_first_row"] .meta-category a,
	#header-outer[data-format="left-header"] .sf-menu .sub-menu .current-menu-item > a, .republicpg_icon_wrap[data-color="accent-color"] i, .republicpg_team_member_close .inner:before, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul > a:hover, body:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul > a:hover, .masonry.material .masonry-blog-item .meta-category a, .post-area.featured_img_left .meta-category a,
	body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-item.has-ul > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-ancestor.has-ul > a, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="accent-color-underline"].full-width-section a.active, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="accent-color-underline"].full-width-section a:hover,  .material .comment-list .reply a:hover, .related-posts[data-style="material"] .meta-category a,
	 body[data-dropdown-style="minimal"].material:not([data-header-color="custom"]) #header-outer:not([data-format="left-header"]) header#top nav >ul >li:not(.megamenu) ul.cart_list a:hover, body.material #header-outer:not(.transparent) .cart-outer:hover .cart-menu-wrap .icon-blueprint-cart,  .material .widget li:not(.has-img) a:hover .post-title, .material #sidebar .widget li:not(.has-img) a:hover .post-title, .material .container-wrap #author-bio #author-info a:hover,
	 .material #sidebar .widget ul[data-style="featured-image-left"] li a:hover .post-title, body.material .tabbed[data-color-scheme="accent-color"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a:hover, body.material .tabbed[data-color-scheme="accent-color"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a.active-tab, body.material .widget:not(.republicpg_popular_posts_widget):not(.recent_posts_extra_widget) li a:hover, .material .widget .tagcloud a, .material #sidebar .widget .tagcloud a, .single.material .post-area .content-inner > .post-tags a, .tabbed[data-style*="material"][data-color-scheme="accent-color"] ul.wpb_tabs_nav li a:not(.active-tab):hover, body.material .republicpg-button.see-through.accent-color[data-color-override="false"],
	 div[data-style="minimal_small"] .toggle.accent-color > h3 a:hover, div[data-style="minimal_small"] .toggle.accent-color.open > h3 a, .republicpg_single_testimonial[data-color="accent-color"] p span.open-quote, .republicpg-quick-view-box .star-rating, .minimal.product .product-wrap .normal.icon-blueprint-cart[class*=" icon-"], .minimal.product .product-wrap i, .minimal.product .product-wrap .normal.icon-blueprint-m-eye, .woocommerce-account .woocommerce > #customer_login .republicpg-form-controls .control.active, .woocommerce-account .woocommerce > #customer_login .republicpg-form-controls .control:hover, .products li.product.minimal .product-add-to-cart .loading:after, .widget_search .search-form button[type=submit] .icon-blueprint-search, body.search-no-results .search-form button[type=submit] .icon-blueprint-search, .woocommerce #review_form #respond p.comment-notes span.required,
	 .republicpg-icon-list[data-icon-color="accent-color"] .republicpg-icon-list-item .list-icon-holder[data-icon_type="numerical"]
	{
		color:'. $options["accent-color"].';
	}

	.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.accent-color.alt-style.hovered, body .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.accent-color.alt-style.hovered,
	.ascend #header-outer:not(.transparent) .cart-outer:hover .cart-menu-wrap:not(.has_products) .icon-blueprint-cart {
		color:'. $options["accent-color"].';
	}

	.republicpg_icon_wrap .svg-icon-holder[data-color="accent-color"] svg path { stroke:'. $options["accent-color"].'; }

	.orbit-wrapper div.slider-nav span.right, .orbit-wrapper div.slider-nav span.left, .flex-direction-nav a, .jp-play-bar,
	.jp-volume-bar-value, .jcarousel-prev:hover, .jcarousel-next:hover, .portfolio-items .col[data-default-color="true"] .work-item:not(.style-3) .work-info-bg, .portfolio-items .col[data-default-color="true"] .bottom-meta,
	.portfolio-filters a, .portfolio-filters #sort-portfolio, .project-attrs li span, .progress li span, .republicpg-progress-bar span,
	#footer-outer #footer-widgets .col .tagcloud a:hover, #sidebar .widget .tagcloud a:hover, article.post .more-link span:hover, #fp-nav.tooltip ul li .fp-tooltip .tooltip-inner,
	article.post.quote .post-content .quote-inner, article.post.link .post-content .link-inner, #pagination .next a:hover, #pagination .prev a:hover,
	.comment-list .reply a:hover, input[type=submit]:hover, input[type="button"]:hover, #footer-outer #copyright li a.vimeo:hover, #footer-outer #copyright li a.behance:hover,
 .tabbed > ul li a.active-tab, [class*=" icon-"], .icon-normal, .bar_graph li span, .republicpg-button[data-color-override="false"].regular-button, .republicpg-button.tilt.accent-color, body .swiper-slide .button.transparent_2 a.primary-color:hover, #footer-outer #footer-widgets .col input[type="submit"],
	.carousel-prev:hover, .carousel-next:hover, body .products-carousel .carousel-next:hover, body .products-carousel .carousel-prev:hover, .blog-recent .more-link span:hover, .post-tags a:hover, .pricing-column.highlight h3, .pricing-table[data-style="flat-alternative"] .pricing-column.highlight h3 .highlight-reason, .pricing-table[data-style="flat-alternative"] .pricing-column.accent-color:before, #to-top:hover, #to-top.dark:hover, body[data-button-style*="rounded"] #to-top:after, #pagination a.page-numbers:hover,
	#pagination span.page-numbers.current, .single-portfolio .facebook-share a:hover, .single-portfolio .twitter-share a:hover, .single-portfolio .pinterest-share a:hover,
	.single-post .facebook-share a:hover, .single-post .twitter-share a:hover, .single-post .pinterest-share a:hover, .mejs-controls .mejs-time-rail .mejs-time-current,
	.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current, .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
	article.post.quote .post-content .quote-inner, article.post.link .post-content .link-inner, article.format-status .post-content .status-inner, article.post.format-aside .aside-inner,
	body #header-secondary-outer #social li a.behance:hover, body #header-secondary-outer #social li a.vimeo:hover, #sidebar .widget:hover [class^="icon-"].icon-3x, .woocommerce-page button.single_add_to_cart_button,
	article.post.quote .content-inner .quote-inner .whole-link, .masonry.classic_enhanced article.post.quote.wide_tall .post-content a:hover .quote-inner, .masonry.classic_enhanced article.post.link.wide_tall .post-content a:hover .link-inner, .iosSlider .prev_slide:hover, .iosSlider .next_slide:hover, body [class^="icon-"].icon-3x.alt-style.accent-color, body [class*=" icon-"].icon-3x.alt-style.accent-color, #slide-out-widget-area, #slide-out-widget-area-bg.fullscreen, #slide-out-widget-area-bg.fullscreen-alt .bg-inner,
	#header-outer .widget_shopping_cart a.button, '.$social_accent_color_rounded.' #header-outer a.cart-contents .cart-wrap span, #header-outer a#mobile-cart-link .cart-wrap span, .swiper-slide .button.solid_color a, .swiper-slide .button.solid_color_2 a, .portfolio-filters,
	header#top nav ul .slide-out-widget-area-toggle a:hover i.lines, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:after, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:before, header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] a:hover i.lines-button:after,  #buddypress a.button:focus, .text_on_hover.product a.added_to_cart, .woocommerce div.product .woocommerce-tabs .full-width-content ul.tabs li a:after,
     .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce #order_review #payment #place_order, .woocommerce .span_4 input[type="submit"].checkout-button,
    .portfolio-filters-inline[data-color-scheme="accent-color"], .select2-container .select2-choice:hover, .select2-dropdown-open .select2-choice,
    header#top nav > ul > li.button_solid_color > a:before, #header-outer.transparent header#top nav > ul > li.button_solid_color > a:before, .tabbed[data-style*="minimal"] > ul li a:after, .twentytwenty-handle, .twentytwenty-horizontal .twentytwenty-handle:before, .twentytwenty-horizontal .twentytwenty-handle:after, .twentytwenty-vertical .twentytwenty-handle:before, .twentytwenty-vertical .twentytwenty-handle:after, .masonry.classic_enhanced .posts-container article .meta-category a:hover, .blog-recent[data-style*="classic_enhanced"] .meta-category a:hover, .masonry.classic_enhanced .posts-container article .video-play-button, .bottom_controls #portfolio-nav .controls li a i:after, .bottom_controls #portfolio-nav ul:first-child li#all-items a:hover i, .republicpg_video_lightbox.republicpg-button[data-color="default-accent-color"],  .republicpg_video_lightbox.republicpg-button[data-color="transparent-accent-color"]:hover,
    .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] blockquote.is-selected p, .republicpg-recent-posts-slider .container .strong span:before, #page-header-bg[data-post-hs="default_minimal"] .inner-wrap > a:hover,
    .single .heading-title[data-header-style="default_minimal"] .meta-category a:hover, body.single-post .sharing-default-minimal .republicpg-love.loved, .republicpg-fancy-box:after, .divider-small-border[data-color="accent-color"], .divider-border[data-color="accent-color"], div[data-style="minimal"] .toggle.open h3 i:after, div[data-style="minimal"] .toggle:hover h3 i:after, div[data-style="minimal"] .toggle.open h3 i:before, div[data-style="minimal"] .toggle:hover h3 i:before,
    .republicpg-animated-title[data-color="accent-color"] .republicpg-animated-title-inner:after, #fp-nav:not(.light-controls).tooltip_alt ul li a span:after, #fp-nav.tooltip_alt ul li a span:after, .republicpg-video-box[data-color="default-accent-color"] a.republicpg_video_lightbox,  body .republicpg-video-box[data-color="default-accent-color"][data-hover="zoom_button"] a.republicpg_video_lightbox:after, .span_12.dark .owl-theme .owl-dots .owl-dot.active span, .span_12.dark .owl-theme .owl-dots .owl-dot:hover span, .republicpg_image_with_hotspots[data-stlye="color_pulse"][data-color="accent-color"] .republicpg_hotspot, .republicpg_image_with_hotspots .republicpg_hotspot_wrap .nttip .tipclose span:before, .republicpg_image_with_hotspots .republicpg_hotspot_wrap .nttip .tipclose span:after,
    .portfolio-filters-inline[data-color-scheme="accent-color-underline"] a:after, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li:not(.megamenu) ul a:hover, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li:not(.megamenu) li.sfHover > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) li.sfHover > a, body[data-dropdown-style="minimal"] header#top nav > ul > li.megamenu > ul ul li a:hover, body[data-dropdown-style="minimal"] header#top nav > ul > li.megamenu > ul ul li.sfHover > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul ul li.current-menu-item > a, body[data-dropdown-style="minimal"] #header-outer .widget_shopping_cart a.button, body[data-dropdown-style="minimal"] #header-secondary-outer ul > li:not(.megamenu) li.sfHover > a, body[data-dropdown-style="minimal"] #header-secondary-outer ul > li:not(.megamenu) ul a:hover, .republicpg-recent-posts-single_featured .strong a,
     .post-area.standard-minimal article.post .more-link span:before, .republicpg-slide-in-cart .widget_shopping_cart a.button, body[data-header-format="left-header"] #header-outer[data-lhe="animated_underline"] header#top nav ul li:not([class*="button_"]) > a span:after, .woocommerce .material.product .add_to_cart_button,
     body nav.woocommerce-pagination span.page-numbers.current, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul a:hover,   .masonry.material .masonry-blog-item .meta-category a:before, .related-posts[data-style="material"] .meta-category a:before, .post-area.featured_img_left .meta-category a:before, .material.masonry .masonry-blog-item .video-play-button,
     .republicpg_icon_wrap[data-style="border-animation"][data-color="accent-color"]:not([data-draw="true"]) .republicpg_icon:hover, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-item > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-ancestor > a, .republicpg-social-sharing-fixed > a:before, .republicpg-social-sharing-fixed .republicpg-social a, body.material #page-header-bg.fullscreen-header .inner-wrap >a, .masonry.material .quote-inner:before, .masonry.material .link-inner:before,
     .tabbed[data-style="minimal_alt"] .magic-line, .republicpg-google-map[data-republicpg-marker-color="accent-color"] .animated-dot .middle-dot, .republicpg-leaflet-map[data-republicpg-marker-color="accent-color"] .animated-dot .middle-dot, .republicpg-google-map[data-republicpg-marker-color="accent-color"] .animated-dot div[class*="signal"], .republicpg-leaflet-map[data-republicpg-marker-color="accent-color"] .animated-dot div[class*="signal"], .republicpg_video_lightbox.play_button_with_text[data-color="default-accent-color"] span.play > .inner-wrap:before, .republicpg-hor-list-item[data-color="accent-color"]:before, body.material #slide-out-widget-area-bg.slide-out-from-right, .widget  .material .widget .tagcloud a:before, .material #sidebar .widget .tagcloud a:before, .single .post-area .content-inner > .post-tags a:before, .auto_meta_overlaid_spaced article.post.quote .n-post-bg:after, .auto_meta_overlaid_spaced article.post.link .n-post-bg:after,
		 .post-area.featured_img_left .posts-container .article-content-wrap  .video-play-button, .post-area.featured_img_left article.post .quote-inner:before, .post-area.featured_img_left .link-inner:before, .republicpg-recent-posts-single_featured.multiple_featured .controls li:after,
		 .republicpg-recent-posts-single_featured.multiple_featured .controls li.active:before, [data-style="list_featured_first_row"] .meta-category a:before,
		 .tabbed[data-style*="material"][data-color-scheme="accent-color"] ul:after, .republicpg-fancy-box[data-color="accent-color"]:not([data-style="default"]) .box-bg:after, div[data-style="minimal_small"] .toggle.accent-color > h3:after,
		 body.material[data-button-style^="rounded"] .republicpg-button.see-through.accent-color[data-color-override="false"] i, .portfolio-items .col.republicpg-new-item .inner-wrap:before, body.material .republicpg-video-box[data-color="default-accent-color"] a.republicpg_video_lightbox:before,
		 .republicpg_team_member_overlay .team_member_details .bio-inner .mobile-close:before, .republicpg_team_member_overlay .team_member_details .bio-inner .mobile-close:after, .fancybox-navigation button:hover:before, ul.products li.minimal.product span.onsale, .span_12.dark .republicpg-woo-flickity[data-controls="arrows-and-text"] .republicpg-woo-carousel-top a:after,
		  .woocommerce span.onsale .republicpg-quick-view-box .onsale, .republicpg-quick-view-box .onsale, .woocommerce-page .republicpg-quick-view-box .onsale, .republicpg-quick-view-box .cart .quantity input.plus:hover, .republicpg-quick-view-box .cart .quantity input.minus:hover, .woocommerce .cart .quantity input.plus:hover, .woocommerce .cart .quantity input.minus:hover, body .republicpg-quick-view-box .single_add_to_cart_button, .woocommerce .classic .add_to_cart_button,
			.woocommerce .classic .product-add-to-cart a.button, .text_on_hover.product .republicpg_quick_view, body.original li.bypostauthor .comment-body:before, .widget_layered_nav ul.yith-wcan-label li a:hover, .widget_layered_nav ul.yith-wcan-label li.chosen a, .republicpg-next-section-wrap.bounce a:before   '.$woocommerce_main.'
	{
		background-color:'.$options["accent-color"].';
	}

	.col:hover > [class^="icon-"].icon-3x:not(.alt-style).accent-color.hovered, .col:hover > [class*=" icon-"].icon-3x:not(.alt-style).accent-color.hovered, body .republicpg-button.see-through-2[data-hover-color-override="false"]:hover,
	.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x:not(.alt-style).accent-color.hovered, .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x:not(.alt-style).accent-color.hovered {
		background-color:'.$options["accent-color"].';
	}

	.republicpg-highlighted-text em:before,
	.republicpg_icon_wrap[data-style="soft-bg"][data-color="accent-color"] .republicpg_icon:before { 	background-color:'.$options["accent-color"].'; }

	body.material[data-button-style^="rounded"] .republicpg-button.see-through.accent-color[data-color-override="false"] i:after { box-shadow: '.$options["accent-color"].' 0px 8px 15px; opacity: 0.24; }

  .republicpg-fancy-box[data-style="color_box_hover"][data-color="accent-color"]:hover:before { box-shadow: 0 30px 90px '.$options["accent-color"].'; }

	.woocommerce.material .widget_price_filter .ui-slider .ui-slider-handle:before, .material.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle:before {
		box-shadow: 0 0 0 10px '.$options["accent-color"].' inset ;
	}
	.woocommerce.material .widget_price_filter .ui-slider .ui-slider-handle.ui-state-active:before, .material.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle.ui-state-active:before {
		box-shadow: 0 0 0 2px '.$options["accent-color"].' inset ;
	}

	.woocommerce #sidebar .widget_layered_nav ul.yith-wcan-color li.chosen a {
		box-shadow: 0 0 0 2px '.$options["accent-color"].', inset 0 0 0 3px #fff;
	}
	.woocommerce #sidebar .widget_layered_nav ul.yith-wcan-color li a:hover {
		box-shadow: 0 0 0 2px '.$options["accent-color"].', 0px 8px 20px rgba(0,0,0,0.2), inset 0 0 0 3px #fff;
	}

	.republicpg-leaflet-map[data-republicpg-marker-color="accent-color"] .republicpg-leaflet-pin { border: 10px solid '.$options["accent-color"].'; }

	.woocommerce-account .woocommerce > #customer_login .republicpg-form-controls .control {
    background-image: linear-gradient(to right, '.$options["accent-color"].' 0%, '.$options["accent-color"].' 100%);
	}

	#search-results article.result .title a {
    background-image: linear-gradient(to right, '.$options["accent-color"].' 0%, '.$options["accent-color"].' 100%);
	}
	.tabbed[data-style*="material"][data-color-scheme="accent-color"] ul li a.active-tab:after {  box-shadow: 0px 18px 50px  '.$options["accent-color"].'; }

	.bottom_controls #portfolio-nav ul:first-child  li#all-items a:hover i { box-shadow: -.6em 0 '.$options["accent-color"].', -.6em .6em '.$options["accent-color"].', .6em 0 '.$options["accent-color"].', .6em -.6em '.$options["accent-color"].', 0 -.6em '.$options["accent-color"].', -.6em -.6em '.$options["accent-color"].', 0 .6em '.$options["accent-color"].', .6em .6em '.$options["accent-color"].';  }

	.tabbed > ul li a.active-tab, body[data-form-style="minimal"] label:after, body .recent_projects_widget a:hover img, .recent_projects_widget a:hover img, #sidebar #flickr a:hover img, body .republicpg-button.see-through-2[data-hover-color-override="false"]:hover,
	#footer-outer #flickr a:hover img, '.$social_accent_color_rounded.' #featured article .post-title a:hover, #header-outer[data-lhe="animated_underline"] header#top nav > ul > li > a:after, body #featured article .post-title a:hover, div.wpcf7-validation-errors, .select2-container .select2-choice:hover, .select2-dropdown-open .select2-choice, body:not(.original) li.bypostauthor img.avatar,
	#header-outer:not(.transparent) header#top nav > ul > li.button_bordered > a:hover:before, .single #single-meta ul li:not(.meta-share-count):hover a, .single #project-meta ul li:not(.meta-share-count):hover a,
	.republicpg_image_with_hotspots .republicpg_hotspot_wrap .nttip .tipclose, body[data-button-style="rounded"] #pagination > a:hover,  .republicpg_icon_wrap[data-style="border-basic"][data-color="accent-color"] .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="accent-color"]:not([data-draw="true"]) .republicpg_icon,
	.republicpg_icon_wrap[data-style="border-animation"][data-color="accent-color"][data-draw="true"]:hover .republicpg_icon, .span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="default-accent-color"] span.play:before, .span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="default-accent-color"] span.play:after, .material #header-secondary-outer[data-lhe="animated_underline"] nav >ul.sf-menu >li >a:after, .material blockquote::before,
	body.material .republicpg-button.see-through.accent-color[data-color-override="false"], .woocommerce-page.material .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce-account[data-form-submit="see-through"] .woocommerce-form-login button.button, .woocommerce-account[data-form-submit="see-through"] .woocommerce-form-register button.button,
	blockquote.wp-block-quote:before {
		border-color:'.$options["accent-color"].';
	}
	.material input[type=text]:focus, .material textarea:focus, .material input[type=email]:focus, .material input[type=search]:focus, .material input[type=password]:focus, .material input[type=tel]:focus,
	.material input[type=url]:focus, .material input[type=date]:focus, .row .col .wp-caption .wp-caption-text, .material.woocommerce-page input#coupon_code:focus {
		border-color:'.$options["accent-color"].';
	}
	body[data-form-style="minimal"] input[type=text]:focus, body[data-form-style="minimal"] textarea:focus, body[data-form-style="minimal"] input[type=email]:focus, body[data-form-style="minimal"] input[type=search]:focus, body[data-form-style="minimal"] input[type=password]:focus, body[data-form-style="minimal"] input[type=tel]:focus,
	body[data-form-style="minimal"] input[type=url]:focus, body[data-form-style="minimal"] input[type=date]:focus,
	.single-product .product[data-gallery-style="left_thumb_sticky"] .product-thumbs .flickity-slider .thumb.is-nav-selected img,
	.single-product:not(.mobile) .product[data-gallery-style="left_thumb_sticky"] .product-thumbs .thumb a.active img {
		border-color:'.$options["accent-color"].';
	}

	@media only screen and (max-width: 768px) {
		.woocommerce-page table.cart a.remove {
			background-color:'.$options["accent-color"].';
		}
	}

	#fp-nav:not(.light-controls).tooltip_alt ul li a.active span, #fp-nav.tooltip_alt ul li a.active span { box-shadow: inset 0 0 0 2px '.$options["accent-color"].'; -webkit-box-shadow: inset 0 0 0 2px '.$options["accent-color"].'; }

	.default-loading-icon:before { border-top-color:'.$options["accent-color"].'; }

	#header-outer a.cart-contents span:before, #fp-nav.tooltip ul li .fp-tooltip .tooltip-inner:after { border-color: transparent '.$options["accent-color"].'; }

	body .col:not(.post-area):not(.span_12):not(#sidebar):hover .hovered .circle-border, body #sidebar .widget:hover .circle-border, body .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] blockquote .bottom-arrow:after, body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="accent-color"] blockquote .bottom-arrow:after, .portfolio-items[data-ps="6"] .bg-overlay, .portfolio-items[data-ps="6"].no-masonry .bg-overlay,
	.republicpg_team_member_close .inner, .republicpg_team_member_overlay .team_member_details .bio-inner .mobile-close { border-color:'.$options["accent-color"].'; }

	.widget .republicpg_widget[class*="republicpg_blog_posts_"] .arrow-circle svg circle,
	.republicpg-woo-flickity[data-controls="arrows-and-text"] .flickity-prev-next-button svg circle.time { stroke: '.$options["accent-color"].'; }

	.gallery a:hover img { border-color:'.$options["accent-color"].'; }';


	if(!empty($options['responsive']) && $options['responsive'] == 1) {

		echo '@media only screen
		and (min-width : 1px) and (max-width : 1000px) {

			body #featured article .post-title > a { background-color:'. $options["accent-color"].'; }

			body #featured article .post-title > a { border-color:'. $options["accent-color"].'; }
		}';

	}


	if(!empty($options["extra-color-1"])) {
		/*Extra Color 1*/
		echo '

		.republicpg-button.regular-button.extra-color-1, .republicpg-button.tilt.extra-color-1 { background-color: '.$options["extra-color-1"].'; }

		.icon-3x[class^="icon-"].extra-color-1:not(.alt-style), .icon-tiny[class^="icon-"].extra-color-1, .icon-3x[class*=" icon-"].extra-color-1:not(.alt-style) , body .icon-3x[class*=" icon-"].extra-color-1:not(.alt-style)  .circle-border, #header-outer .widget_shopping_cart .cart_list li a.remove,  #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, .republicpg-milestone .number.extra-color-1, span.extra-color-1,
		.team-member ul.social.extra-color-1 li a, .stock.out-of-stock, body [class^="icon-"].icon-default-style.extra-color-1, body [class^="icon-"].icon-default-style[data-color="extra-color-1"], .team-member a.extra-color-1:hover,
		.pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-1 h3, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-1 h4, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-1 .interval,
		.svg-icon-holder[data-color="extra-color-1"], div[data-style="minimal"] .toggle.extra-color-1:hover h3 a, div[data-style="minimal"] .toggle.extra-color-1.open h3 a, .republicpg-icon-list[data-icon-style="border"][data-icon-color="extra-color-1"] .list-icon-holder[data-icon_type="numerical"] span, .republicpg-icon-list[data-icon-color="extra-color-1"][data-icon-style="border"] .content h4,
		 .republicpg_icon_wrap[data-color="extra-color-1"] i, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="extra-color-1-underline"].full-width-section a.active, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="extra-color-1-underline"].full-width-section a:hover, .testimonial_slider[data-rating-color="extra-color-1"] .star-rating .filled:before,
		 header#top nav > ul > li.button_bordered_2 > a:hover, body.material .tabbed[data-color-scheme="extra-color-1"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a:hover, body.material .tabbed[data-color-scheme="extra-color-1"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a.active-tab, .tabbed[data-style*="material"][data-color-scheme="extra-color-1"] ul li a:not(.active-tab):hover,
		 body.material .republicpg-button.see-through.extra-color-1[data-color-override="false"], div[data-style="minimal_small"] .toggle.extra-color-1 > h3 a:hover, div[data-style="minimal_small"] .toggle.extra-color-1.open > h3 a,
		 .republicpg_single_testimonial[data-color="extra-color-1"] p span.open-quote, .republicpg-icon-list[data-icon-color="extra-color-1"] .republicpg-icon-list-item .list-icon-holder[data-icon_type="numerical"] {
			color: '.$options["extra-color-1"].';
		}

		.col:hover > [class^="icon-"].icon-3x.extra-color-1:not(.alt-style), .col:hover > [class*=" icon-"].icon-3x.extra-color-1:not(.alt-style).hovered, body .swiper-slide .button.transparent_2 a.extra-color-1:hover,
		body .col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-1:not(.alt-style).hovered, body .col:not(.post-area):not(#sidebar):not(.span_12):hover a [class*=" icon-"].icon-3x.extra-color-1:not(.alt-style).hovered, #sidebar .widget:hover [class^="icon-"].icon-3x.extra-color-1:not(.alt-style),
		.portfolio-filters-inline[data-color-scheme="extra-color-1"], .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-1:before, .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-1 h3 .highlight-reason, .republicpg-button.republicpg_video_lightbox[data-color="default-extra-color-1"],  .republicpg_video_lightbox.republicpg-button[data-color="transparent-extra-color-1"]:hover,
		.testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] blockquote.is-selected p, .republicpg-fancy-box[data-color="extra-color-1"]:after, .divider-small-border[data-color="extra-color-1"], .divider-border[data-color="extra-color-1"], div[data-style="minimal"] .toggle.extra-color-1.open i:after, div[data-style="minimal"] .toggle.extra-color-1:hover i:after, div[data-style="minimal"] .toggle.open.extra-color-1 i:before, div[data-style="minimal"] .toggle.extra-color-1:hover i:before, body .tabbed[data-color-scheme="extra-color-1"][data-style="minimal"] > ul li:not(.cta-button) a:after,
		.republicpg-animated-title[data-color="extra-color-1"] .republicpg-animated-title-inner:after, .republicpg-video-box[data-color="extra-color-1"] a.republicpg_video_lightbox,  body .republicpg-video-box[data-color="extra-color-1"][data-hover="zoom_button"] a.republicpg_video_lightbox:after, .republicpg_image_with_hotspots[data-stlye="color_pulse"][data-color="extra-color-1"] .republicpg_hotspot, .portfolio-filters-inline[data-color-scheme="extra-color-1-underline"] a:after, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-1"]:not([data-draw="true"]) .republicpg_icon:hover,  .republicpg-google-map[data-republicpg-marker-color="extra-color-1"] .animated-dot .middle-dot, .republicpg-leaflet-map[data-republicpg-marker-color="extra-color-1"] .animated-dot .middle-dot, .republicpg-google-map[data-republicpg-marker-color="extra-color-1"] .animated-dot div[class*="signal"], .republicpg-leaflet-map[data-republicpg-marker-color="extra-color-1"] .animated-dot div[class*="signal"], .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-1"] span.play > .inner-wrap:before,
		.republicpg-hor-list-item[data-color="extra-color-1"]:before, header#top nav > ul > li.button_solid_color_2 > a:before, #header-outer.transparent header#top nav > ul > li.button_solid_color_2 > a:before, body[data-slide-out-widget-area-style="slide-out-from-right"]:not([data-header-color="custom"]).material a.slide_out_area_close:before,
		.tabbed[data-color-scheme="extra-color-1"][data-style="minimal_alt"] .magic-line, .tabbed[data-color-scheme="extra-color-1"][data-style="default"] li:not(.cta-button) a.active-tab, .tabbed[data-style*="material"][data-color-scheme="extra-color-1"] ul:after, .tabbed[data-style*="material"][data-color-scheme="extra-color-1"] ul li a.active-tab,
		.republicpg-fancy-box[data-color="extra-color-1"]:not([data-style="default"]) .box-bg:after, body.material[data-button-style^="rounded"] .republicpg-button.see-through.extra-color-1[data-color-override="false"] i,
		.republicpg-recent-posts-single_featured.multiple_featured .controls[data-color="extra-color-1"] li:after, body.material .republicpg-video-box[data-color="extra-color-1"] a.republicpg_video_lightbox:before,
		 div[data-style="minimal_small"] .toggle.extra-color-1 > h3:after, .republicpg_icon_wrap[data-style="soft-bg"][data-color="extra-color-1"] .republicpg_icon:before
		{
			background-color: '.$options["extra-color-1"].';
		}

		body [class^="icon-"].icon-3x.alt-style.extra-color-1, body [class*=" icon-"].icon-3x.alt-style.extra-color-1, [class*=" icon-"].extra-color-1.icon-normal, .extra-color-1.icon-normal, .bar_graph li span.extra-color-1, .republicpg-progress-bar span.extra-color-1, #header-outer .widget_shopping_cart a.button, .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale, .swiper-slide .button.solid_color a.extra-color-1, .swiper-slide .button.solid_color_2 a.extra-color-1, .toggle.open.extra-color-1 h3 a {
			background-color: '.$options["extra-color-1"].';
		}

		.col:hover > [class^="icon-"].icon-3x.extra-color-1.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-1.alt-style.hovered, .no-highlight.extra-color-1 h3,
		.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-1.alt-style.hovered, body .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-1.alt-style.hovered {
			color: '.$options["extra-color-1"].';
		}

		.republicpg-leaflet-map[data-republicpg-marker-color="extra-color-1"] .republicpg-leaflet-pin { border: 10px solid '.$options["extra-color-1"].'; }

		.republicpg_icon_wrap .svg-icon-holder[data-color="extra-color-1"] svg path { stroke:'. $options["extra-color-1"].'; }

		body.material[data-button-style^="rounded"] .republicpg-button.see-through.extra-color-1[data-color-override="false"] i:after { box-shadow: '.$options["extra-color-1"].' 0px 8px 15px; opacity: 0.24; }

		.tabbed[data-style*="material"][data-color-scheme="extra-color-1"] ul li a.active-tab:after {  box-shadow: 0px 18px 50px  '.$options["extra-color-1"].'; }
		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-1"]:hover:before { box-shadow: 0 30px 90px '.$options["extra-color-1"].'; }

		body .col:not(.post-area):not(.span_12):not(#sidebar):hover .extra-color-1.hovered .circle-border, #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, #header-outer .woocommerce.widget_shopping_cart .cart_list li a.remove, body #sidebar .widget:hover .extra-color-1 .circle-border,
		body .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] blockquote .bottom-arrow:after,
		body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-1"] blockquote .bottom-arrow:after, div[data-style="minimal"] .toggle.open.extra-color-1 i, div[data-style="minimal"] .toggle.extra-color-1:hover i,
		.republicpg_icon_wrap[data-style="border-basic"][data-color="extra-color-1"] .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-1"]:not([data-draw="true"]) .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-1"][data-draw="true"]:hover .republicpg_icon,
		.span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-1"] span.play:before, .span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-1"] span.play:after,
		#header-outer:not(.transparent) header#top nav > ul > li.button_bordered_2 > a:hover:before { border-color:'.$options["extra-color-1"].'; }

		.tabbed[data-color-scheme="extra-color-1"][data-style="default"] li:not(.cta-button) a.active-tab,  body.material .republicpg-button.see-through.extra-color-1[data-color-override="false"] { border-color:'.$options["extra-color-1"].'; }

		.pricing-column.highlight.extra-color-1 h3 { background-color:'.$options["extra-color-1"].'; }

		';
	}

	/*Extra Color 2*/
	if(!empty($options["extra-color-2"])) {
		echo '

		.republicpg-button.regular-button.extra-color-2, .republicpg-button.tilt.extra-color-2 { background-color: '.$options["extra-color-2"].'; }

		.icon-3x[class^="icon-"].extra-color-2:not(.alt-style), .icon-3x[class*=" icon-"].extra-color-2:not(.alt-style), .icon-tiny[class^="icon-"].extra-color-2, body .icon-3x[class*=" icon-"].extra-color-2  .circle-border, .republicpg-milestone .number.extra-color-2, span.extra-color-2, .team-member ul.social.extra-color-2 li a, body [class^="icon-"].icon-default-style.extra-color-2, body [class^="icon-"].icon-default-style[data-color="extra-color-2"], .team-member a.extra-color-2:hover,
		.pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-2 h3, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-2 h4, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-2 .interval,
		.svg-icon-holder[data-color="extra-color-2"], div[data-style="minimal"] .toggle.extra-color-2:hover h3 a, div[data-style="minimal"] .toggle.extra-color-2.open h3 a, .republicpg-icon-list[data-icon-style="border"][data-icon-color="extra-color-2"] .list-icon-holder[data-icon_type="numerical"] span, .republicpg-icon-list[data-icon-color="extra-color-2"][data-icon-style="border"] .content h4,
		.republicpg_icon_wrap[data-color="extra-color-2"] i, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="extra-color-2-underline"].full-width-section a.active, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="extra-color-2-underline"].full-width-section a:hover, .testimonial_slider[data-rating-color="extra-color-2"] .star-rating .filled:before,
		body.material .tabbed[data-color-scheme="extra-color-2"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a:hover, body.material .tabbed[data-color-scheme="extra-color-2"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a.active-tab, .tabbed[data-style*="material"][data-color-scheme="extra-color-2"] ul li a:not(.active-tab):hover,
		body.material .republicpg-button.see-through.extra-color-2[data-color-override="false"], div[data-style="minimal_small"] .toggle.extra-color-2 > h3 a:hover, div[data-style="minimal_small"] .toggle.extra-color-2.open > h3 a,
		.republicpg_single_testimonial[data-color="extra-color-2"] p span.open-quote, .republicpg-icon-list[data-icon-color="extra-color-2"] .republicpg-icon-list-item .list-icon-holder[data-icon_type="numerical"] {
			color: '.$options["extra-color-2"].';
		}

		.col:hover > [class^="icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, body .swiper-slide .button.transparent_2 a.extra-color-2:hover,
		.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-2:not(.alt-style).hovered, #sidebar .widget:hover [class^="icon-"].icon-3x.extra-color-2:not(.alt-style), .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-2 h3 .highlight-reason,  .republicpg-button.republicpg_video_lightbox[data-color="default-extra-color-2"],  .republicpg_video_lightbox.republicpg-button[data-color="transparent-extra-color-2"]:hover,
		.testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] blockquote.is-selected p, .republicpg-fancy-box[data-color="extra-color-2"]:after, .divider-small-border[data-color="extra-color-2"], .divider-border[data-color="extra-color-2"], div[data-style="minimal"] .toggle.extra-color-2.open i:after, div[data-style="minimal"] .toggle.extra-color-2:hover i:after, div[data-style="minimal"] .toggle.open.extra-color-2 i:before, div[data-style="minimal"] .toggle.extra-color-2:hover i:before, body .tabbed[data-color-scheme="extra-color-2"][data-style="minimal"] > ul li:not(.cta-button) a:after,
		.republicpg-animated-title[data-color="extra-color-2"] .republicpg-animated-title-inner:after, .republicpg-video-box[data-color="extra-color-2"] a.republicpg_video_lightbox, body .republicpg-video-box[data-color="extra-color-2"][data-hover="zoom_button"] a.republicpg_video_lightbox:after, .republicpg_image_with_hotspots[data-stlye="color_pulse"][data-color="extra-color-2"] .republicpg_hotspot, .portfolio-filters-inline[data-color-scheme="extra-color-2-underline"] a:after, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-2"]:not([data-draw="true"]) .republicpg_icon:hover, .republicpg-google-map[data-republicpg-marker-color="extra-color-2"] .animated-dot .middle-dot,  .republicpg-leaflet-map[data-republicpg-marker-color="extra-color-2"] .animated-dot .middle-dot, .republicpg-google-map[data-republicpg-marker-color="extra-color-2"] .animated-dot div[class*="signal"], .republicpg-leaflet-map[data-republicpg-marker-color="extra-color-2"] .animated-dot div[class*="signal"], .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-2"] span.play > .inner-wrap:before,
		.republicpg-hor-list-item[data-color="extra-color-2"]:before, .tabbed[data-color-scheme="extra-color-2"][data-style="minimal_alt"] .magic-line, .tabbed[data-style*="material"][data-color-scheme="extra-color-2"] ul:after, .tabbed[data-style*="material"][data-color-scheme="extra-color-2"] ul li a.active-tab,
		.republicpg-fancy-box[data-color="extra-color-2"]:not([data-style="default"]) .box-bg:after, body.material[data-button-style^="rounded"] .republicpg-button.see-through.extra-color-2[data-color-override="false"] i,
		.republicpg-recent-posts-single_featured.multiple_featured .controls[data-color="extra-color-2"] li:after, body.material .republicpg-video-box[data-color="extra-color-2"] a.republicpg_video_lightbox:before,
		div[data-style="minimal_small"] .toggle.extra-color-2 > h3:after, .republicpg_icon_wrap[data-style="soft-bg"][data-color="extra-color-2"] .republicpg_icon:before
		{
			background-color: '.$options["extra-color-2"].';
		}

		.republicpg_icon_wrap .svg-icon-holder[data-color="extra-color-2"] svg path { stroke:'. $options["extra-color-2"].'; }

		.republicpg-leaflet-map[data-republicpg-marker-color="extra-color-2"] .republicpg-leaflet-pin { border: 10px solid '.$options["extra-color-2"].'; }

		body [class^="icon-"].icon-3x.alt-style.extra-color-2, body [class*=" icon-"].icon-3x.alt-style.extra-color-2, [class*=" icon-"].extra-color-2.icon-normal, .extra-color-2.icon-normal, .bar_graph li span.extra-color-2, .republicpg-progress-bar span.extra-color-2, .woocommerce .product-wrap .add_to_cart_button.added, .woocommerce-message, .woocommerce-error, .woocommerce-info,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .swiper-slide .button.solid_color a.extra-color-2, .swiper-slide .button.solid_color_2 a.extra-color-2, .toggle.open.extra-color-2 h3 a,
		.portfolio-filters-inline[data-color-scheme="extra-color-2"], .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-2:before {
			background-color: '.$options["extra-color-2"].';
		}

		.col:hover > [class^="icon-"].icon-3x.extra-color-2.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-2.alt-style.hovered, .no-highlight.extra-color-2 h3,
		.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-2.alt-style.hovered, body .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-2.alt-style.hovered {
			color: '.$options["extra-color-2"].';
		}

		body.material[data-button-style^="rounded"] .republicpg-button.see-through.extra-color-2[data-color-override="false"] i:after { box-shadow: '.$options["extra-color-2"].' 0px 8px 15px; opacity: 0.24; }

		.tabbed[data-style*="material"][data-color-scheme="extra-color-2"] ul li a.active-tab:after {  box-shadow: 0px 18px 50px  '.$options["extra-color-2"].'; }
		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-2"]:hover:before { box-shadow: 0 30px 90px '.$options["extra-color-2"].'; }

		body .col:not(.post-area):not(.span_12):not(#sidebar):hover .extra-color-2.hovered .circle-border, body #sidebar .widget:hover .extra-color-2 .circle-border,
		body .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] blockquote .bottom-arrow:after,
		body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-2"] blockquote .bottom-arrow:after, div[data-style="minimal"] .toggle.open.extra-color-2 i, div[data-style="minimal"] .toggle.extra-color-2:hover i,
		.republicpg_icon_wrap[data-style="border-basic"][data-color="extra-color-2"] .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-2"]:not([data-draw="true"]) .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-2"][data-draw="true"]:hover .republicpg_icon,
		.span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-2"] span.play:before, .span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-2"] span.play:after { border-color:'.$options["extra-color-2"].'; }

		.pricing-column.highlight.extra-color-2 h3 { background-color:'.$options["extra-color-2"].'; }
		.tabbed[data-color-scheme="extra-color-2"][data-style="default"] li:not(.cta-button) a.active-tab, body.material .republicpg-button.see-through.extra-color-2[data-color-override="false"] { border-color:'.$options["extra-color-2"].'; }
		';
	}


	/*Extra Color 3*/
	if(!empty($options["extra-color-3"])) {
		echo '

		.republicpg-button.regular-button.extra-color-3, .republicpg-button.tilt.extra-color-3 { background-color: '.$options["extra-color-3"].'; }

	    .icon-3x[class^="icon-"].extra-color-3:not(.alt-style) , .icon-3x[class*=" icon-"].extra-color-3:not(.alt-style) , .icon-tiny[class^="icon-"].extra-color-3, body .icon-3x[class*=" icon-"].extra-color-3  .circle-border, .republicpg-milestone .number.extra-color-3, span.extra-color-3, .team-member ul.social.extra-color-3 li a, body [class^="icon-"].icon-default-style.extra-color-3, body [class^="icon-"].icon-default-style[data-color="extra-color-3"], .team-member a.extra-color-3:hover,
	    .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-3 h3, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-3 h4, .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-3 .interval,
	    .svg-icon-holder[data-color="extra-color-3"], div[data-style="minimal"] .toggle.extra-color-3:hover h3 a, div[data-style="minimal"] .toggle.extra-color-3.open h3 a, .republicpg-icon-list[data-icon-style="border"][data-icon-color="extra-color-3"] .list-icon-holder[data-icon_type="numerical"] span, .republicpg-icon-list[data-icon-color="extra-color-3"][data-icon-style="border"] .content h4,
	    .republicpg_icon_wrap[data-color="extra-color-3"] i, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="extra-color-3-underline"].full-width-section a.active, body .wpb_row .span_12 .portfolio-filters-inline[data-color-scheme="extra-color-3-underline"].full-width-section a:hover, .testimonial_slider[data-rating-color="extra-color-3"] .star-rating .filled:before,
			body.material .tabbed[data-color-scheme="extra-color-3"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a:hover, body.material .tabbed[data-color-scheme="extra-color-3"][data-style="minimal"]:not(.using-icons) >ul li:not(.cta-button) a.active-tab, .tabbed[data-style*="material"][data-color-scheme="extra-color-3"] ul li a:not(.active-tab):hover,
			body.material .republicpg-button.see-through.extra-color-3[data-color-override="false"], div[data-style="minimal_small"] .toggle.extra-color-3 > h3 a:hover, div[data-style="minimal_small"] .toggle.extra-color-3.open > h3 a,
			.republicpg_single_testimonial[data-color="extra-color-3"] p span.open-quote, .republicpg-icon-list[data-icon-color="extra-color-3"] .republicpg-icon-list-item .list-icon-holder[data-icon_type="numerical"] {
			color: '.$options["extra-color-3"].';
		}
	    .col:hover > [class^="icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, body .swiper-slide .button.transparent_2 a.extra-color-3:hover,
		.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-3:not(.alt-style).hovered, #sidebar .widget:hover [class^="icon-"].icon-3x.extra-color-3:not(.alt-style),
		.portfolio-filters-inline[data-color-scheme="extra-color-3"], .pricing-table[data-style="flat-alternative"] .pricing-column.extra-color-3:before, .pricing-table[data-style="flat-alternative"] .pricing-column.highlight.extra-color-3 h3 .highlight-reason,  .republicpg-button.republicpg_video_lightbox[data-color="default-extra-color-3"],  .republicpg_video_lightbox.republicpg-button[data-color="transparent-extra-color-3"]:hover,
		.testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] .flickity-page-dots .dot.is-selected:before, .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] blockquote.is-selected p, .republicpg-fancy-box[data-color="extra-color-3"]:after, .divider-small-border[data-color="extra-color-3"], .divider-border[data-color="extra-color-3"], div[data-style="minimal"] .toggle.extra-color-3.open i:after, div[data-style="minimal"] .toggle.extra-color-3:hover i:after, div[data-style="minimal"] .toggle.open.extra-color-3 i:before, div[data-style="minimal"] .toggle.extra-color-3:hover i:before, body .tabbed[data-color-scheme="extra-color-3"][data-style="minimal"] > ul li:not(.cta-button) a:after,
		.republicpg-animated-title[data-color="extra-color-3"] .republicpg-animated-title-inner:after , .republicpg-video-box[data-color="extra-color-3"] a.republicpg_video_lightbox, body .republicpg-video-box[data-color="extra-color-3"][data-hover="zoom_button"] a.republicpg_video_lightbox:after, .republicpg_image_with_hotspots[data-stlye="color_pulse"][data-color="extra-color-3"] .republicpg_hotspot, .portfolio-filters-inline[data-color-scheme="extra-color-3-underline"] a:after, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-3"]:not([data-draw="true"]) .republicpg_icon:hover, .republicpg-google-map[data-republicpg-marker-color="extra-color-3"] .animated-dot .middle-dot, .republicpg-leaflet-map[data-republicpg-marker-color="extra-color-3"] .animated-dot .middle-dot, .republicpg-google-map[data-republicpg-marker-color="extra-color-3"] .animated-dot div[class*="signal"], .republicpg-leaflet-map[data-republicpg-marker-color="extra-color-3"] .animated-dot div[class*="signal"], .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-3"] span.play > .inner-wrap:before,
		.republicpg-hor-list-item[data-color="extra-color-3"]:before, .tabbed[data-color-scheme="extra-color-3"][data-style="minimal_alt"] .magic-line, .tabbed[data-style*="material"][data-color-scheme="extra-color-3"] ul:after, .tabbed[data-style*="material"][data-color-scheme="extra-color-3"] ul li a.active-tab,
		.republicpg-fancy-box[data-color="extra-color-3"]:not([data-style="default"]) .box-bg:after, body.material[data-button-style^="rounded"] .republicpg-button.see-through.extra-color-3[data-color-override="false"] i,
		.republicpg-recent-posts-single_featured.multiple_featured .controls[data-color="extra-color-3"] li:after, body.material .republicpg-video-box[data-color="extra-color-3"] a.republicpg_video_lightbox:before,
		div[data-style="minimal_small"] .toggle.extra-color-3 > h3:after, .republicpg_icon_wrap[data-style="soft-bg"][data-color="extra-color-3"] .republicpg_icon:before
		{
			background-color: '.$options["extra-color-3"].';
		}

		.republicpg_icon_wrap .svg-icon-holder[data-color="extra-color-3"] svg path { stroke:'. $options["extra-color-3"].'; }

		.republicpg-leaflet-map[data-republicpg-marker-color="extra-color-3"] .republicpg-leaflet-pin { border: 10px solid '.$options["extra-color-3"].'; }

		body [class^="icon-"].icon-3x.alt-style.extra-color-3, body [class*=" icon-"].icon-3x.alt-style.extra-color-3, .extra-color-3.icon-normal, [class*=" icon-"].extra-color-3.icon-normal, .bar_graph li span.extra-color-3, .republicpg-progress-bar span.extra-color-3, .swiper-slide .button.solid_color a.extra-color-3, .swiper-slide .button.solid_color_2 a.extra-color-3, .toggle.open.extra-color-3 h3 a  {
			background-color: '.$options["extra-color-3"].';
		}

		.col:hover > [class^="icon-"].icon-3x.extra-color-3.alt-style.hovered, .col:hover > [class*=" icon-"].icon-3x.extra-color-3.alt-style.hovered, .no-highlight.extra-color-3 h3,
		.col:not(.post-area):not(.span_12):not(#sidebar):hover [class^="icon-"].icon-3x.extra-color-3.alt-style.hovered, body .col:not(.post-area):not(.span_12):not(#sidebar):hover a [class*=" icon-"].icon-3x.extra-color-3.alt-style.hovered {
			color: '.$options["extra-color-3"].';
		}

		body.material[data-button-style^="rounded"] .republicpg-button.see-through.extra-color-3[data-color-override="false"] i:after { box-shadow: '.$options["extra-color-3"].' 0px 8px 15px; opacity: 0.24; }
		.tabbed[data-style*="material"][data-color-scheme="extra-color-3"] ul li a.active-tab:after {  box-shadow: 0px 18px 50px  '.$options["extra-color-3"].'; }
		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-3"]:hover:before { box-shadow: 0 30px 90px '.$options["extra-color-3"].'; }

		body .col:not(.post-area):not(.span_12):not(#sidebar):hover .extra-color-3.hovered .circle-border, body #sidebar .widget:hover .extra-color-3 .circle-border,
		body .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] blockquote .bottom-arrow:after,
		body .dark .testimonial_slider[data-style="multiple_visible"][data-color*="extra-color-3"] blockquote .bottom-arrow:after, div[data-style="minimal"] .toggle.open.extra-color-3 i, div[data-style="minimal"] .toggle.extra-color-3:hover i,
		.republicpg_icon_wrap[data-style="border-basic"][data-color="extra-color-3"] .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-3"]:not([data-draw="true"]) .republicpg_icon, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-3"][data-draw="true"]:hover .republicpg_icon,
		.span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-3"] span.play:before, .span_12.dark .republicpg_video_lightbox.play_button_with_text[data-color="extra-color-3"] span.play:after { border-color:'.$options["extra-color-3"].'; }

		.pricing-column.highlight.extra-color-3 h3 { background-color:'.$options["extra-color-3"].'; }
		.tabbed[data-color-scheme="extra-color-3"][data-style="default"] li:not(.cta-button) a.active-tab, body.material .republicpg-button.see-through.extra-color-3[data-color-override="false"] { border-color:'.$options["extra-color-3"].'; }
		';
	}

	/*Extra Color Gradient 1*/
	if($options["extra-color-gradient"]['to'] && $options["extra-color-gradient"]['from']) {
		$accent_gradient_1_from = $options["extra-color-gradient"]['from'];
		$accent_gradient_1_to = $options["extra-color-gradient"]['to'];

		echo '.divider-small-border[data-color="extra-color-gradient-1"], .divider-border[data-color="extra-color-gradient-1"], .republicpg-progress-bar span.extra-color-gradient-1,
		.widget ul.republicpg_widget[class*="republicpg_blog_posts_"][data-style="hover-featured-image-gradient-and-counter"] > li a .popular-featured-img:after, .tabbed[data-style*="minimal"][data-color-scheme="extra-color-gradient-1"] >ul li a:after, .tabbed[data-style="minimal_alt"][data-color-scheme="extra-color-gradient-1"] .magic-line,
		.republicpg-recent-posts-single_featured.multiple_featured .controls[data-color="extra-color-gradient-1"] li:after, .republicpg-fancy-box[data-style="default"][data-color="extra-color-gradient-1"]:after {
			background: '.$accent_gradient_1_from.';
		    background: linear-gradient(to right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
		}
		.icon-normal.extra-color-gradient-1,  body [class^="icon-"].icon-3x.alt-style.extra-color-gradient-1, .republicpg-button.extra-color-gradient-1:after, .republicpg-button.see-through-extra-color-gradient-1:after,
		.republicpg_icon_wrap[data-color="extra-color-gradient-1"] i, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-gradient-1"]:before, .tabbed[data-style*="material"][data-color-scheme="extra-color-gradient-1"] ul li a:before,
		.tabbed[data-style*="default"][data-color-scheme="extra-color-gradient-1"] ul li a:before, .tabbed[data-style*="vertical"][data-color-scheme="extra-color-gradient-1"] ul li a:before,
		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-gradient-1"] .box-bg:after, .republicpg_icon_wrap[data-style="soft-bg"][data-color="extra-color-gradient-1"] .republicpg_icon:before {
			background: '.$accent_gradient_1_from.';
		    background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
		}
		body.material .republicpg-button.regular.m-extra-color-gradient-1, body.material .republicpg-button.see-through.m-extra-color-gradient-1:before,
		.swiper-slide .button.solid_color a.extra-color-gradient-1, .swiper-slide .button.transparent_2 a.extra-color-gradient-1:before {
			background: '.$accent_gradient_1_from.';
		   background: linear-gradient(125deg, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
		}
		body.material .republicpg-button.regular.m-extra-color-gradient-1:before {
			 background: '.$accent_gradient_1_to.';
		}
		.tabbed[data-style*="material"][data-color-scheme="extra-color-gradient-1"] ul:after { background-color: '.$accent_gradient_1_to.';}
		.tabbed[data-style*="material"][data-color-scheme="extra-color-gradient-1"] ul li a.active-tab:after { box-shadow: 0px 18px 50px '.$accent_gradient_1_to.'; }

		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-gradient-1"]:hover:before { box-shadow: 0px 30px 90px '.$accent_gradient_1_to.'; }

		.testimonial_slider[data-rating-color="extra-color-gradient-1"] .star-rating .filled:before {
			 color: '.$accent_gradient_1_from.';
			  background: linear-gradient(to right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
		}

		.republicpg-button.extra-color-gradient-1, .republicpg-button.see-through-extra-color-gradient-1 {
			 border-width: 3px;
			 border-style: solid;
		    -moz-border-image: -moz-linear-gradient(top right, '.$accent_gradient_1_from.' 0%, '.$accent_gradient_1_to.' 100%);
		    -webkit-border-image: -webkit-linear-gradient(top right, '.$accent_gradient_1_from.' 0%,'.$accent_gradient_1_to.' 100%);
		    border-image: linear-gradient(to bottom right, '.$accent_gradient_1_from.' 0%, '.$accent_gradient_1_to.' 100%);
		    border-image-slice: 1;
		}
		.republicpg-gradient-text[data-color="extra-color-gradient-1"][data-direction="horizontal"] * { background-image: linear-gradient(to right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');  }
		.republicpg-gradient-text[data-color="extra-color-gradient-1"] *, .republicpg-icon-list[data-icon-style="border"][data-icon-color="extra-color-gradient-1"] .list-icon-holder[data-icon_type="numerical"] span {
			 color: '.$accent_gradient_1_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: inline-block;
		}

		[class^="icon-"][data-color="extra-color-gradient-1"]:before, [class*=" icon-"][data-color="extra-color-gradient-1"]:before,
		[class^="icon-"].extra-color-gradient-1:not(.icon-normal):before, [class*=" icon-"].extra-color-gradient-1:not(.icon-normal):before,
		.republicpg_icon_wrap[data-color="extra-color-gradient-1"] i {
			  color: '.$accent_gradient_1_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial;
		}
		.republicpg-button.extra-color-gradient-1 .hover, .republicpg-button.see-through-extra-color-gradient-1 .start {
			  background: '.$accent_gradient_1_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_1_from.', '.$accent_gradient_1_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial;
		}
		.republicpg-button.extra-color-gradient-1.no-text-grad .hover, .republicpg-button.see-through-extra-color-gradient-1.no-text-grad .start {
			 background: transparent;
			 color: '.$accent_gradient_1_from.';
		}';
	}

	/*Extra Color Gradient 2*/
	if($options["extra-color-gradient-2"]['to'] && $options["extra-color-gradient-2"]['from']) {
		$accent_gradient_2_from = $options["extra-color-gradient-2"]['from'];
		$accent_gradient_2_to = $options["extra-color-gradient-2"]['to'];

		echo '.divider-small-border[data-color="extra-color-gradient-2"], .divider-border[data-color="extra-color-gradient-2"], .republicpg-progress-bar span.extra-color-gradient-2, .tabbed[data-style*="minimal"][data-color-scheme="extra-color-gradient-2"] >ul li a:after,  .tabbed[data-style="minimal_alt"][data-color-scheme="extra-color-gradient-2"] .magic-line,
		.republicpg-recent-posts-single_featured.multiple_featured .controls[data-color="extra-color-gradient-2"] li:after, .republicpg-fancy-box[data-style="default"][data-color="extra-color-gradient-2"]:after {
			background: '.$accent_gradient_2_from.';
		    background: linear-gradient(to right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
		}
		.icon-normal.extra-color-gradient-2, body [class^="icon-"].icon-3x.alt-style.extra-color-gradient-2, .republicpg-button.extra-color-gradient-2:after, .republicpg-button.see-through-extra-color-gradient-2:after,
		.republicpg_icon_wrap[data-color="extra-color-gradient-2"] i, .republicpg_icon_wrap[data-style="border-animation"][data-color="extra-color-gradient-2"]:before, .tabbed[data-style*="material"][data-color-scheme="extra-color-gradient-2"] ul li a:before,
		.tabbed[data-style*="default"][data-color-scheme="extra-color-gradient-2"] ul li a:before, .tabbed[data-style*="vertical"][data-color-scheme="extra-color-gradient-2"] ul li a:before,
		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-gradient-2"] .box-bg:after, .republicpg_icon_wrap[data-style="soft-bg"][data-color="extra-color-gradient-2"] .republicpg_icon:before {
			background: '.$accent_gradient_2_from.';
		    background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
		}
		body.material .republicpg-button.regular.m-extra-color-gradient-2,
		body.material .republicpg-button.see-through.m-extra-color-gradient-2:before,
		.swiper-slide .button.solid_color a.extra-color-gradient-2,
		.swiper-slide .button.transparent_2 a.extra-color-gradient-2:before {
			background: '.$accent_gradient_2_from.';
		   background: linear-gradient(125deg, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
		}
		body.material .republicpg-button.regular.m-extra-color-gradient-2:before {
			 background: '.$accent_gradient_2_to.';
		}

		.tabbed[data-style*="material"][data-color-scheme="extra-color-gradient-2"] ul:after { background-color: '.$accent_gradient_2_to.';}
		.tabbed[data-style*="material"][data-color-scheme="extra-color-gradient-2"] ul li a.active-tab:after { box-shadow: 0px 18px 50px '.$accent_gradient_2_to.'; }

		.republicpg-fancy-box[data-style="color_box_hover"][data-color="extra-color-gradient-2"]:hover:before { box-shadow: 0px 30px 90px '.$accent_gradient_2_to.'; }

		.testimonial_slider[data-rating-color="extra-color-gradient-2"] .star-rating .filled:before {
			 color: '.$accent_gradient_2_from.';
			  background: linear-gradient(to right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
		}

		.republicpg-button.extra-color-gradient-2, .republicpg-button.see-through-extra-color-gradient-2 {
			 border-width: 3px;
			 border-style: solid;
		    -moz-border-image: -moz-linear-gradient(top right, '.$accent_gradient_2_from.' 0%, '.$accent_gradient_2_to.' 100%);
		    -webkit-border-image: -webkit-linear-gradient(top right, '.$accent_gradient_2_from.' 0%,'.$accent_gradient_2_to.' 100%);
		    border-image: linear-gradient(to bottom right, '.$accent_gradient_2_from.' 0%, '.$accent_gradient_2_to.' 100%);
		    border-image-slice: 1;
		}
		.republicpg-gradient-text[data-color="extra-color-gradient-2"][data-direction="horizontal"] * { background-image: linear-gradient(to right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');  }
		.republicpg-gradient-text[data-color="extra-color-gradient-2"] *, .republicpg-icon-list[data-icon-style="border"][data-icon-color="extra-color-gradient-2"] .list-icon-holder[data-icon_type="numerical"] span {
			 color: '.$accent_gradient_2_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: inline-block;
		}

		[class^="icon-"][data-color="extra-color-gradient-2"]:before, [class*=" icon-"][data-color="extra-color-gradient-2"]:before,
		[class^="icon-"].extra-color-gradient-2:not(.icon-normal):before, [class*=" icon-"].extra-color-gradient-2:not(.icon-normal):before,
		.republicpg_icon_wrap[data-color="extra-color-gradient-2"] i {
			  color: '.$accent_gradient_2_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial;
		}
		.republicpg-button.extra-color-gradient-2 .hover, .republicpg-button.see-through-extra-color-gradient-2 .start {
			  background: '.$accent_gradient_2_from.';
			  background: linear-gradient(to bottom right, '.$accent_gradient_2_from.', '.$accent_gradient_2_to.');
			  -webkit-background-clip: text;
			  -webkit-text-fill-color: transparent;
			  background-clip: text;
			  text-fill-color: transparent;
			  display: initial;
		}
		.republicpg-button.extra-color-gradient-2.no-text-grad .hover, .republicpg-button.see-through-extra-color-gradient-2.no-text-grad .start {
			background: transparent;
			color: '.$accent_gradient_2_from.';
		}

		';
	}

	/*custom bg/font colors*/
	if(!empty($options['overall-bg-color'])) {
		echo 'html .container-wrap, .material .ocm-effect-wrap, .project-title, html .ascend .container-wrap, html .ascend .project-title, html body .vc_text_separator div, html .carousel-wrap[data-full-width="true"] .carousel-heading, html .carousel-wrap span.left-border, html .carousel-wrap span.right-border, .single-post.ascend #page-header-bg.fullscreen-header, .single-post #single-below-header.fullscreen-header,
			html #page-header-wrap, html .page-header-no-bg, html #full_width_portfolio .project-title.parallax-effect, html .portfolio-items .col, html .page-template-template-portfolio-php .portfolio-items .col.span_3, html .page-template-template-portfolio-php .portfolio-items .col.span_4
		{ background-color: '.$options['overall-bg-color'].'; }';
	}
	if(!empty($options['overall-font-color'])) {
		echo 'html body, body h1, body h2, body h3, body h4, body h5, body h6, .masonry.material .masonry-blog-item .grav-wrap .text { color: #756E67 }';
		echo '#project-meta .republicpg-love { color: #0F1D2B }';
		/* dark color fixes */
		if($options['overall-font-color'] != '#000000' && $options['overall-font-color'] != '#0a0a0a' && $options['overall-font-color'] != '#111111' && $options['overall-font-color'] != '#222222' && $options['overall-font-color'] != '#333333') {
			echo '.full-width-section > .col.span_12.dark, .full-width-content > .col.span_12.dark {

			}';
			echo '.full-width-section > .col.span_12.dark h1, .full-width-content > .col.span_12.dark h1,
			.full-width-section > .col.span_12.dark h2, .full-width-content > .col.span_12.dark h2,
			.full-width-section > .col.span_12.dark h3, .full-width-content > .col.span_12.dark h3,
			.full-width-section > .col.span_12.dark h4, .full-width-content > .col.span_12.dark h4,
			.full-width-section > .col.span_12.dark h5, .full-width-content > .col.span_12.dark h5,
			.full-width-section > .col.span_12.dark h6, .full-width-content > .col.span_12.dark h6 {
				color: #756e67;
			}
			.full-width-section  > .col.span_12.dark .portfolio-items .col h3,
			.full-width-section  > .col.span_12.dark .portfolio-items[data-ps="6"] .work-meta h4 { color: #fff; } ';
		}
	}

	/*Custom header colors*/
	if(!empty($options['header-color']) && $options['header-color'] == 'custom') {

		if(!empty($options['header-background-color'])) {
			echo 'body #header-outer, body #search-outer, .material #header-space, #header-space, .material #header-outer .bg-color-stripe, .material #search-outer .bg-color-stripe, .material #header-outer #search-outer:before, body.material[data-header-format="centered-menu-bottom-bar"] #page-header-wrap.fullscreen-header { background-color:'.$options['header-background-color'].'; }';
		}

		 /*custom header bg opacity*/
		 if(!empty($options['header-bg-opacity'])) {

		 		 $navBGColor = $options['header-background-color'];
		 		 $navBGColor = substr($navBGColor,1);
				 $colorR = hexdec( substr( $navBGColor, 0, 2 ) );
				 $colorG = hexdec( substr( $navBGColor, 2, 2 ) );
				 $colorB = hexdec( substr( $navBGColor, 4, 2 ) );
				 $colorA = ($options['header-bg-opacity'] != '100') ? '0.'.$options['header-bg-opacity'] : $options['header-bg-opacity'];

				 echo 'body #header-outer, body[data-header-color="dark"] #header-outer { background-color: rgba('.$colorR.','.$colorG.','.$colorB.','.$colorA.'); }';

				 //material search
				 echo '.material #header-outer:not(.transparent) .bg-color-stripe { display: none; }';
		}

		if(!empty($options['header-font-color'])) {
			echo 'header#top nav > ul > li > a, header#top #logo, header#top .span_9 > .slide-out-widget-area-toggle i, .sf-sub-indicator [class^="icon-"], body[data-header-color="custom"].ascend #boxed #header-outer .cart-menu .cart-icon-wrap i,  body.ascend #boxed #header-outer .cart-menu .cart-icon-wrap i, .sf-sub-indicator [class*=" icon-"], header#top nav ul #search-btn a span, header#top nav ul #republicpg-user-account a span, header#top #toggle-nav i, header#top #toggle-nav i, .material #header-outer:not([data-permanent-transparent="1"]) .mobile-search .icon-blueprint-search, #header-outer:not([data-permanent-transparent="1"]) .mobile-user-account .icon-blueprint-m-user, header#top #mobile-cart-link i, #header-outer .cart-menu .cart-icon-wrap .icon-blueprint-cart, #search-outer #search input[type="text"], #search-outer #search #close a span,
			body[data-header-format="left-header"] #social-in-menu a, .material #search-outer #search .span_12 span { color:'.$options['header-font-color'].'; }';
			echo '.material #header-outer #search-outer input::-webkit-input-placeholder { color:'.$options['header-font-color'].'; }';
			echo 'header#top nav ul .slide-out-widget-area-toggle a i.lines, header#top nav ul .slide-out-widget-area-toggle a i.lines:after, #header-outer .slide-out-widget-area-toggle[data-icon-animation="simple-transform"]:not(.mobile-icon) .lines-button:after, header#top nav ul .slide-out-widget-area-toggle a i.lines:before,
			header#top .slide-out-widget-area-toggle.mobile-icon .lines-button.x2 .lines:before, header#top .slide-out-widget-area-toggle.mobile-icon  .lines-button.x2 .lines:after, header#top .slide-out-widget-area-toggle[data-icon-animation="simple-transform"].mobile-icon .lines-button:after, header#top .slide-out-widget-area-toggle[data-icon-animation="spin-and-transform"].mobile-icon .lines-button.x2 .lines,  body.material.mobile #header-outer.transparent:not(.directional-nav-effect):not([data-permanent-transparent="1"]) header .slide-out-widget-area-toggle a .close-line, body.material.mobile #header-outer:not(.directional-nav-effect):not([data-permanent-transparent="1"]) header .slide-out-widget-area-toggle a .close-line, #search-outer .close-wrap .close-line { background-color:'.$options['header-font-color'].'; }';
			echo 'header#top nav > ul > li.button_bordered > a:before, #header-outer:not(.transparent) header#top .slide-out-widget-area-toggle .close-line { border-color:'.$options['header-font-color'].'; }';
		}

		if(!empty($options['header-font-hover-color'])) {
			echo '#header-outer:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, body #header-outer:not(.transparent) #social-in-menu a i:after, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav > ul > li > a:hover, header#top #logo:hover, .ascend #header-outer:not(.transparent) .cart-outer:hover .cart-menu-wrap:not(.has_products) .icon-blueprint-cart, body.material #header-outer:not(.transparent) .cart-outer:hover .cart-menu-wrap .icon-blueprint-cart, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-item > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_item > a .sf-sub-indicator i, body header#top nav .sf-menu > li.current_page_ancestor > a .sf-sub-indicator i, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.sfHover > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_ancestor > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a i,  body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current_page_item > a, body header#top nav .sf-menu > li.current_page_item > a .sf-sub-indicator [class^="icon-"], body header#top nav .sf-menu > li.current_page_ancestor > a .sf-sub-indicator [class^="icon-"], body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu > li.current-menu-ancestor > a, body .sf-menu > li.sfHover > a .sf-sub-indicator [class^="icon-"], body .sf-menu > li:hover > a .sf-sub-indicator [class^="icon-"], body .sf-menu > li:hover > a, header#top nav ul #search-btn a:hover span, header#top nav ul #republicpg-user-account a:hover span, header#top nav ul .slide-out-widget-area-toggle a:hover span, body:not(.material) #search-outer #search #close a span:hover { color:'.$options['header-font-hover-color'].'; }';
			echo 'header#top nav ul .slide-out-widget-area-toggle a:hover i.lines, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:after, body header#top nav ul .slide-out-widget-area-toggle[data-icon-animation="simple-transform"] a:hover .lines-button:after, header#top nav ul .slide-out-widget-area-toggle a:hover i.lines:before,
			body[data-header-format="left-header"] #header-outer[data-lhe="animated_underline"] header#top nav > ul > li:not([class*="button_"]) > a > span:after { background-color:'.$options['header-font-hover-color'].'; }';
			echo '#header-outer[data-lhe="animated_underline"] header#top nav > ul > li > a:after, body.material #header-outer #search-outer #search input[type="text"] { border-color:'.$options['header-font-hover-color'].'; }';
		}

		if(!empty($options['header-dropdown-background-color'])) {
			echo '#search-outer .ui-widget-content, header#top .sf-menu li ul li a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top .sf-menu li ul, header#top nav > ul > li.megamenu > ul.sub-menu, body header#top nav > ul > li.megamenu > ul.sub-menu > li > a, #header-outer .widget_shopping_cart .cart_list a, #header-secondary-outer ul ul li a, #header-outer .widget_shopping_cart .cart_list li, .woocommerce .cart-notification, #header-outer .widget_shopping_cart_content, body[data-dropdown-style="minimal"] #header-secondary-outer .sf-menu li ul { background-color:'.$options['header-dropdown-background-color'].'; }';
			echo 'html body[data-header-format="left-header"] #header-outer .cart-outer .cart-notification:after { border-color: transparent transparent '.$options['header-dropdown-background-color'].' transparent; } ';
		}

		if(!empty($options['header-dropdown-background-hover-color'])) {
			echo 'header#top .sf-menu li ul li a:hover, body header#top nav .sf-menu ul li.sfHover > a, header#top .sf-menu li ul li.current-menu-item > a, header#top .sf-menu li ul li.current-menu-ancestor > a, header#top nav > ul > li.megamenu > ul ul li a:hover, header#top nav > ul > li.megamenu > ul ul li.current-menu-item > a, #header-secondary-outer ul ul li a:hover, body #header-secondary-outer .sf-menu ul li.sfHover > a, #search-outer .ui-widget-content li:hover, .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li:not(.megamenu) ul a:hover, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li:not(.megamenu) li.sfHover > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) li.sfHover > a, body[data-dropdown-style="minimal"] header#top nav > ul > li.megamenu > ul ul li a:hover, body[data-dropdown-style="minimal"] header#top nav > ul > li.megamenu > ul ul li.sfHover > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul a:hover, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul ul li.current-menu-item > a,  body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-item > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-ancestor > a { background-color:'.$options['header-dropdown-background-hover-color'].'; }';
		}

		if(!empty($options['header-dropdown-font-color'])) {
			echo '#search-outer .ui-widget-content li a, #search-outer .ui-widget-content i, header#top .sf-menu li ul li a, body #header-outer .widget_shopping_cart .cart_list a, #header-secondary-outer ul ul li a, .woocommerce .cart-notification .item-name, .cart-outer .cart-notification, .sf-menu li ul .sf-sub-indicator [class^="icon-"], .sf-menu li ul .sf-sub-indicator [class*=" icon-"], #header-outer .widget_shopping_cart .quantity,  body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul a, #header-outer .cart-notification .item-name, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li.republicpg-woo-cart .cart-outer .widget ul a:hover, #header-outer .cart-outer .total strong, #header-outer .cart-outer .total,
			 body[data-dropdown-style="minimal"] #header-outer ul.product_list_widget li dl dd,  body[data-dropdown-style="minimal"] #header-outer ul.product_list_widget li dl dt { color:'.$options['header-dropdown-font-color'].'; }';
		}

		if(!empty($options['header-dropdown-font-hover-color'])) {
			echo '#search-outer .ui-widget-content li:hover a .title, #search-outer .ui-widget-content .ui-state-hover .title,  #search-outer .ui-widget-content .ui-state-focus .title, #search-outer .ui-widget-content li:hover a, #search-outer .ui-widget-content li:hover i,  #search-outer .ui-widget-content .ui-state-hover a,  #search-outer .ui-widget-content .ui-state-focus a,  #search-outer .ui-widget-content .ui-state-hover i,  #search-outer .ui-widget-content .ui-state-focus i, #search-outer .ui-widget-content .ui-state-hover span,  #search-outer .ui-widget-content .ui-state-focus span,  body header#top nav .sf-menu ul li.sfHover > a,  header#top nav > ul > li.megamenu > ul ul li.current-menu-item > a, #header-secondary-outer ul ul li:hover > a, body #header-secondary-outer ul ul li:hover > a i, body header#top nav .sf-menu ul li.sfHover > a .sf-sub-indicator i, body header#top nav .sf-menu ul li:hover > a .sf-sub-indicator i, body header#top nav .sf-menu ul li:hover > a, header#top nav > ul > li.megamenu > ul > li > a:hover, header#top nav > ul > li.megamenu > ul > li.sfHover > a, body header#top nav .sf-menu ul li.current-menu-item > a, body #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu ul li.current-menu-item > a, body header#top nav .sf-menu ul li.current_page_item > a .sf-sub-indicator i, body header#top nav .sf-menu ul li.current_page_ancestor > a .sf-sub-indicator i, body header#top nav .sf-menu ul li.sfHover > a, #header-secondary-outer ul li.sfHover > a,  body header#top nav .sf-menu ul li.current_page_ancestor > a, body header#top nav .sf-menu ul li.current-menu-ancestor > a, body header#top nav .sf-menu ul li.current_page_item > a, body header#top nav .sf-menu ul li.current_page_item > a .sf-sub-indicator [class^="icon-"], body header#top nav .sf-menu ul li.current_page_ancestor > a .sf-sub-indicator [class^="icon-"], body header#top nav .sf-menu ul li.current-menu-ancestor > a, body header#top nav .sf-menu ul li.current_page_item > a, body .sf-menu ul li ul li.sfHover > a .sf-sub-indicator [class^="icon-"], body ul.sf-menu > li > a:active > .sf-sub-indicator i, body ul.sf-menu > li.sfHover > a > .sf-sub-indicator i, body .sf-menu ul li.current_page_item > a , body .sf-menu ul li.current-menu-ancestor > a, body .sf-menu ul li.current_page_ancestor > a, body .sf-menu ul a:focus , body .sf-menu ul a:hover, body .sf-menu ul a:active, body .sf-menu ul li:hover > a, body .sf-menu ul li.sfHover > a, .body sf-menu li ul li a:hover, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) li.sfHover > a, body .sf-menu li ul li.sfHover > a, body header#top nav > ul > li.megamenu ul li:hover > a, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li:not(.megamenu) ul a:hover, body[data-dropdown-style="minimal"] #header-outer header#top nav > ul > li:not(.megamenu) li.sfHover > a, body[data-dropdown-style="minimal"] #header-outer header#top nav ul li li.sfHover > a .sf-sub-indicator [class^="icon-"], body[data-dropdown-style="minimal"] header#top nav > ul > li.megamenu > ul ul li a:hover, body[data-dropdown-style="minimal"] header#top nav > ul > li.megamenu > ul ul li.sfHover > a, body[data-dropdown-style="minimal"] #header-outer header#top nav ul li li:hover > a .sf-sub-indicator [class^="icon-"],  body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul a:hover, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul ul li.current-menu-item > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) li.current-menu-item > a,  body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-item > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-ancestor > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li:not(.megamenu) ul li.current-menu-ancestor > a .sf-sub-indicator [class^="icon-"], body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-item > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul > a:hover, body:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li:hover > a, body:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul:hover > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li:hover > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul:hover > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-item.has-ul > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-ancestor.has-ul > a, #header-outer ul.product_list_widget li:hover dl dt, #header-outer ul.product_list_widget li:hover dl dd { color:'.$options['header-dropdown-font-hover-color'].'; }';
		}

		if(!empty($options['header-dropdown-heading-font-color'])) {
			echo 'body:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > a, body:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > a, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.megamenu ul li.current_page_ancestor > a, #header-outer:not([data-lhe="animated_underline"]) header#top nav .sf-menu li.megamenu ul li.current-menu-ancestor > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul > a { color:'.$options['header-dropdown-heading-font-color'].'; }';
		}
		if(!empty($options['header-dropdown-heading-font-hover-color'])) {
			echo 'body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li:hover > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu > ul > li.current-menu-ancestor.menu-item-has-children > a, header#top nav > ul > li.megamenu > ul ul li.current-menu-item > a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top nav > ul > li.megamenu > ul > li > ul > li.has-ul:hover > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-item.has-ul > a, body[data-dropdown-style="minimal"] #header-outer:not([data-format="left-header"]) header#top nav > ul > li.megamenu ul ul li.current-menu-ancestor.has-ul > a  { color:'.$options['header-dropdown-heading-font-hover-color'].'; }';
		}
		if(!empty($options['header-separator-color'])) {
			echo 'body #header-outer[data-transparent-header="true"] header#top nav ul #search-btn > div, body #header-outer[data-transparent-header="true"] header#top nav ul #republicpg-user-account > div, body[data-header-color="custom"] header#top nav ul #search-btn > div,body[data-header-color="custom"] header#top nav ul #republicpg-user-account > div, .ascend #header-outer[data-transparent-header="true"][data-full-width="true"][data-remove-border="true"] header#top nav ul #search-btn a:after, .ascend #header-outer[data-transparent-header="true"][data-full-width="true"][data-remove-border="true"] header#top nav ul #republicpg-user-account a:after, .ascend #header-outer[data-transparent-header="true"][data-full-width="true"][data-remove-border="true"] header#top nav ul .slide-out-widget-area-toggle a:after, .ascend #header-outer[data-transparent-header="true"][data-full-width="true"][data-remove-border="true"] .cart-menu:after, html body[data-dropdown-style="minimal"] #header-outer:not(.transparent) .sf-menu > li ul { border-color:'.$options['header-separator-color'].'; } body[data-dropdown-style="minimal"] #header-outer:not(.transparent) .sf-menu > li ul { border-top-width: 1px; border-top-style: solid; }';
		}
		if(!empty($options['secondary-header-background-color'])) {
			echo '#header-secondary-outer { background-color:'.$options['secondary-header-background-color'].'; }';
		}

		if(!empty($options['secondary-header-font-color'])) {
			echo '#header-secondary-outer nav > ul > li > a, #header-secondary-outer .republicpg-center-text, #header-secondary-outer .republicpg-center-text a, body #header-secondary-outer nav > ul > li > a span.sf-sub-indicator [class^="icon-"], #header-secondary-outer #social li a i, #header-secondary-outer[data-lhe="animated_underline"] nav >ul.sf-menu >li:hover >a { color:'.$options['secondary-header-font-color'].'; }';
		}

		if(!empty($options['secondary-header-font-hover-color'])) {
			echo '#header-secondary-outer #social li a:hover i, #header-secondary-outer .republicpg-center-text a:hover, .material #header-secondary-outer[data-lhe="animated_underline"] nav >ul.sf-menu >li >a:after, #header-secondary-outer nav > ul > li:hover > a, #header-secondary-outer nav > ul > li.current-menu-item > a, #header-secondary-outer nav > ul > li.sfHover > a, #header-secondary-outer nav > ul > li.sfHover > a span.sf-sub-indicator [class^="icon-"], #header-secondary-outer nav > ul > li.current-menu-item > a span.sf-sub-indicator [class^="icon-"], #header-secondary-outer nav > ul > li.current-menu-ancestor > a,  #header-secondary-outer nav > ul > li.current-menu-ancestor > a span.sf-sub-indicator [class^="icon-"], body #header-secondary-outer nav > ul > li:hover > a span.sf-sub-indicator [class^="icon-"] { color:'.$options['secondary-header-font-hover-color'].'; }';
		}

		if(!empty($options['header-dropdown-opacity'])) {

		 		 $dropdownBGColor = $options['header-dropdown-background-color'];
		 		 $dropdownBGColor = substr($dropdownBGColor,1);
				 $colorR = hexdec( substr( $dropdownBGColor, 0, 2 ) );
				 $colorG = hexdec( substr( $dropdownBGColor, 2, 2 ) );
				 $colorB = hexdec( substr( $dropdownBGColor, 4, 2 ) );
				 $colorA = ($options['header-dropdown-opacity'] != '100') ? '0.'.$options['header-dropdown-opacity'] : $options['header-dropdown-opacity'];

				 echo '#search-outer .ui-widget-content, header#top .sf-menu li ul li a, body[data-dropdown-style="minimal"]:not([data-header-format="left-header"]) header#top .sf-menu li ul, header#top nav > ul > li.megamenu > ul.sub-menu, body header#top nav > ul > li.megamenu > ul.sub-menu > li > a, #header-outer .widget_shopping_cart .cart_list a, #header-secondary-outer ul ul li a, #header-outer .widget_shopping_cart .cart_list li, .woocommerce .cart-notification, #header-outer .widget_shopping_cart_content { background-color: rgba('.$colorR.','.$colorG.','.$colorB.','.$colorA.'); }';
		}


		/*Custom slide out widget area colors*/
		if(!empty($options['header-slide-out-widget-area-background-color'])) {
			echo '#slide-out-widget-area:not(.fullscreen-alt):not(.fullscreen), #slide-out-widget-area-bg.fullscreen, #slide-out-widget-area-bg.fullscreen-alt .bg-inner, body.material #slide-out-widget-area-bg.slide-out-from-right  { background-color:'.$options['header-slide-out-widget-area-background-color'].'; }';

			//grad
			if(!empty($options['header-slide-out-widget-area-background-color-2'])) {
				echo 'body:not(.material) #slide-out-widget-area.slide-out-from-right, #slide-out-widget-area.slide-out-from-right-hover, #slide-out-widget-area-bg.fullscreen, #slide-out-widget-area-bg.fullscreen-alt .bg-inner, body.material #slide-out-widget-area-bg.slide-out-from-right { background: linear-gradient(145deg, '.$options['header-slide-out-widget-area-background-color'].', '.$options['header-slide-out-widget-area-background-color-2'].'); }';
			}
		}



		if(!empty($options['header-slide-out-widget-area-color'])) {
			echo '#slide-out-widget-area, body.material #slide-out-widget-area.slide-out-from-right .off-canvas-social-links a:hover i:before, #slide-out-widget-area a, body #slide-out-widget-area a.slide_out_area_close .icon-default-style[class^="icon-"] { color:'.$options['header-slide-out-widget-area-color'].'; }';
			echo '#slide-out-widget-area .tagcloud a,  body.material #slide-out-widget-area[class*="slide-out-from-right"] .off-canvas-menu-container li a:after { border-color: '.$options['header-slide-out-widget-area-color'].'; }';
			echo '.slide-out-hover-icon-effect.slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines:before, .slide-out-hover-icon-effect.slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines:after, .slide-out-hover-icon-effect.slide-out-widget-area-toggle[data-icon-animation="simple-transform"] .lines-button:after { background-color:'.$options['header-slide-out-widget-area-color'].'; }';
		}

		if(!empty($options['header-slide-out-widget-area-header-color'])) {
			echo '#slide-out-widget-area h1, #slide-out-widget-area h2, #slide-out-widget-area h3, #slide-out-widget-area h4, #slide-out-widget-area h5 { color:'.$options['header-slide-out-widget-area-header-color'].'; }';
		}


		if(!empty($options['header-slide-out-widget-area-hover-color'])) {
			echo 'body #slide-out-widget-area.fullscreen a:hover, body.material #slide-out-widget-area.slide-out-from-right .off-canvas-social-links a i:after, body #slide-out-widget-area.slide-out-from-right a:hover, #slide-out-widget-area.fullscreen-alt .inner .off-canvas-menu-container li a:hover, #slide-out-widget-area.slide-out-from-right-hover .inner .off-canvas-menu-container li a:hover, #slide-out-widget-area.slide-out-from-right-hover.no-text-effect .inner .off-canvas-menu-container li a:hover, html body #slide-out-widget-area a.slide_out_area_close:hover .icon-default-style[class^="icon-"], body.material #slide-out-widget-area.slide-out-from-right .off-canvas-menu-container li.current-menu-item > a { color:'.$options['header-slide-out-widget-area-hover-color'].'; }  body.material #slide-out-widget-area[class*="slide-out-from-right"] .off-canvas-menu-container li a:after { border-color:'.$options['header-slide-out-widget-area-hover-color'].'; } ';
			echo '#slide-out-widget-area .tagcloud a:hover { border-color: '.$options['header-slide-out-widget-area-hover-color'].'; }';
		}

		if(!empty($options['header-slide-out-widget-area-close-bg-color'])) {
			echo 'body[data-slide-out-widget-area-style="slide-out-from-right"].material a.slide_out_area_close:before { background-color: '.$options['header-slide-out-widget-area-close-bg-color'].'; } ';
		}
		if(!empty($options['header-slide-out-widget-area-close-icon-color'])) {
			echo '@media only screen and (min-width: 1000px) { body[data-slide-out-widget-area-style="slide-out-from-right"].material a.slide_out_area_close .close-line { background-color: '.$options['header-slide-out-widget-area-close-icon-color'].'; } } ';
		}


	}


	/*Custom footer colors*/
	if(!empty($options['footer-custom-color']) && $options['footer-custom-color'] == '1') {

		if(!empty($options['footer-background-color'])) {
			echo '#footer-outer, #republicpg_fullscreen_rows > #footer-outer.wpb_row .full-page-inner-wrap { background-color:'.$options['footer-background-color'].'; } #footer-outer #footer-widgets { border-bottom: none; } body.original #footer-outer #footer-widgets .col ul li { border-bottom: 1px solid rgba(0,0,0,0.1); } #footer-outer #footer-widgets .col .widget_recent_comments ul li { background-color: rgba(0, 0, 0, 0.07); border-bottom: 0px;} ';
		}

		if(!empty($options['footer-font-color'])) {
			echo '#footer-outer, #footer-outer a:not(.republicpg-button), body[data-form-style="minimal"] #footer-outer #footer-widgets .col input[type=text] { color:'.$options['footer-font-color'].'; }';
		}

		if(!empty($options['footer-secondary-font-color'])) {
			echo '#footer-outer .widget h4, #footer-outer .col .widget_recent_entries span, #footer-outer .col .recent_posts_extra_widget .post-widget-text span { color:'.$options['footer-secondary-font-color'].'; }';
		}

		if(!empty($options['footer-copyright-background-color'])) {
			echo '#footer-outer #copyright, body { border: none; background-color:'.$options['footer-copyright-background-color'].'; }';
		}

		if(!empty($options['footer-copyright-font-color'])) {
			echo '#footer-outer #copyright li a i, #footer-outer #copyright p { color:'.$options['footer-copyright-font-color'].'; } #footer-outer[data-cols="1"] #copyright li a i:after { border-color:'.$options['footer-copyright-font-color'].'; }';
		}

		if(!empty($options['footer-copyright-icon-hover-color'])) {
			echo '#footer-outer #copyright li a:hover i, #footer-outer[data-cols="1"] #copyright li a:hover i, #footer-outer[data-cols="1"] #copyright li a:hover i:after { border-color: '.$options['footer-copyright-icon-hover-color'].'; color:'.$options['footer-copyright-icon-hover-color'].'; }';
		}

		/*copyright border line*/
		if(!empty($options['footer-copyright-line']) && $options['footer-copyright-line'] == '1') {
			echo '#footer-outer #copyright { border-top: 1px solid rgba(255,255,255,0.18); }';
		}
	}

	/*Custom CTA colors*/
	if(!empty($options['cta-background-color'])) {
		echo '#call-to-action { background-color:'.$options['cta-background-color'].'; }';
	}

	if(!empty($options['cta-text-color'])) {
		echo '#call-to-action span { color:'.$options['cta-text-color'].'; }';
	}

	/*slide out widget overlay*/
	$slide_out_widget_overlay = (!empty($options['header-slide-out-widget-area-overlay-opacity'])) ? $options['header-slide-out-widget-area-overlay-opacity'] : 'dark';
	if($slide_out_widget_overlay == 'dark') {
		echo 'body #slide-out-widget-area-bg { background-color: rgba(0,0,0,0.8); }';
	} else if($slide_out_widget_overlay == 'medium') {
		echo 'body #slide-out-widget-area-bg { background-color: rgba(0,0,0,0.6); }';
	} else {
		echo 'body #slide-out-widget-area-bg { background-color: rgba(0,0,0,0.4); }';
	}

	/*blog categories*/
	$theme_skin = (!empty($options['theme-skin'])) ? $options['theme-skin'] : 'default';
	$headerFormat = (!empty($options['header_format'])) ? $options['header_format'] : 'default';
	if($headerFormat == 'centered-menu-bottom-bar') $theme_skin = 'material';

	$masonry_type = (!empty($options['blog_masonry_type'])) ? $options['blog_masonry_type'] : 'classic';
	if($masonry_type == 'classic_enhanced' || $theme_skin == 'material') {

		$categories = get_categories();

		if(!empty($categories)){

			foreach($categories as $k => $v) {

				$t_id =  $v->term_id;
				$terms =  get_option( "taxonomy_$t_id" );

				if(!empty($terms['category_color']))
					echo '.single .heading-title[data-header-style="default_minimal"] .meta-category a.'.$v->slug . ':hover, body.material #page-header-bg.fullscreen-header .inner-wrap >a.'.$v->slug . ', .blog-recent.related-posts[data-style="classic_enhanced"] .meta-category a.'.$v->slug . ':hover, .masonry.classic_enhanced .posts-container article .meta-category a.'.$v->slug . ':hover, #page-header-bg[data-post-hs="default_minimal"] .inner-wrap > a.'.$v->slug . ':hover, .republicpg-recent-posts-slider .container .strong .'.$v->slug.':before, .masonry.material .masonry-blog-item .meta-category a.'.$v->slug . ':before,  [data-style="list_featured_first_row"] .meta-category a.'.$v->slug . ':before, .republicpg-recent-posts-single_featured .strong a.'.$v->slug . ', .related-posts[data-style="material"] .meta-category a.'.$v->slug . ':before,  .post-area.featured_img_left .meta-category a.'.$v->slug . ':before, .post-area.featured_img_left article.quote.category-'.$v->slug . ' .quote-inner:before, .material.masonry .masonry-blog-item.category-'.$v->slug . ' .quote-inner:before, .material.masonry .masonry-blog-item.category-'.$v->slug . ' .video-play-button, .material.masonry .masonry-blog-item.category-'.$v->slug . ' .link-inner:before { background-color: '.$terms['category_color'].'; }

					[data-style="list_featured_first_row"] .meta-category a.'.$v->slug . ', .masonry.material .masonry-blog-item .meta-category a.'.$v->slug . ', .post-area.featured_img_left .meta-category a.'.$v->slug . ', .related-posts[data-style="material"] .meta-category a.'.$v->slug . ' { color: '.$terms['category_color'].'; }';
			}
		}
	}

	global $post;
	$page_full_screen_rows_bg_color = (isset($post->ID)) ? get_post_meta($post->ID, '_republicpg_full_screen_rows_overall_bg_color', true) : '#333333';
	$page_full_screen_rows_animation = (isset($post->ID)) ? get_post_meta($post->ID, '_republicpg_full_screen_rows_animation', true) : '';
	echo '#republicpg_fullscreen_rows { background-color: '.$page_full_screen_rows_bg_color.'; }';
	if($page_full_screen_rows_animation == 'parallax') {
		echo '#republicpg_fullscreen_rows > .wpb_row .full-page-inner-wrap { background-color: '.$page_full_screen_rows_bg_color.'; }';
	}

	if($external_dynamic != 'on') {

		echo '</style>';

		$dynamic_css = ob_get_contents();
		ob_end_clean();

		echo republicpg_quick_minify($dynamic_css);
	}





?>
