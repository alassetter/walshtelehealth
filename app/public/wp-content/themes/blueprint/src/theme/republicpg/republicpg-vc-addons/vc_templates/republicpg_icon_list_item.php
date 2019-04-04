<?php 

extract(shortcode_atts(array("icon_type" => "numerical", 'icon_family' => 'fontawesome', 'icon_fontawesome' => '', 'icon_linea' => '', 'icon_iconsmind' => '', 'icon_steadysets' => '', "header" => "", "text" => ""), $atts));

if( isset($_GET['vc_editable']) ) {
	$republicpg_using_VC_front_end_editor = sanitize_text_field($_GET['vc_editable']);
	$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;
} else {
	$republicpg_using_VC_front_end_editor = false;
}

$icon_markup = null;
switch($icon_family) {
	case 'fontawesome':
		$icon = $icon_fontawesome;
		break;
	case 'steadysets':
		$icon = $icon_steadysets;
		break;
	case 'linea':
		$icon = $icon_linea;
		break;
	case 'iconsmind':
		$icon = $icon_iconsmind;
		break;
	default:
		$icon = '';
		break;
}

if($icon_family == 'linea' && $icon_type != 'numerical' ) wp_enqueue_style('linea'); 

if(!empty($icon)) {
		
	if($republicpg_using_VC_front_end_editor) {
		$icon_markup = '<i class="icon-default-style '.$icon.'" data-color="default"></i>';
	} else {
		$icon_markup = '<i class="icon-default-style '.$icon.'" data-color="'.strtolower($GLOBALS['republicpg-list-item-icon-color']).'"></i>';
	}
	
}

if( $republicpg_using_VC_front_end_editor ) {
	$icon_output = ($icon_type == 'numerical') ? '<span></span>' : $icon_markup;
} else {
	$icon_output = ($icon_type == 'numerical') ? '<span>'. $GLOBALS['republicpg-list-item-count'] . '</span>' : $icon_markup;
}

echo '<div class="republicpg-icon-list-item"><div class="list-icon-holder" data-icon_type="'.$icon_type.'">'.$icon_output.'</div><div class="content"><h4>'.$header.'</h4>'.$text.'</div></div>';

if( !$republicpg_using_VC_front_end_editor ) {
	$GLOBALS['republicpg-list-item-count']++;
}

?>