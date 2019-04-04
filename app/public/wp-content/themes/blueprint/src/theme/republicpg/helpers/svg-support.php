<?php
// Add SVG Support
add_filter('upload_mimes', 'custom_upload_svg');

function custom_upload_svg ( $existing_mimes = array() ) {
	// add your extension to the array
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}

# Add File Types
function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


?>
