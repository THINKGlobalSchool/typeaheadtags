<?php
/**
 * Typeahead Tags Start
 * 
 * @package Typeahead Tags
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 * Includes the autosuggest jQuery plugin: 
 * http://code.drewwilson.com/entry/autosuggest-jquery-plugin
 * 
 * NOTE: I have made some modifications to the file: vendors/autosuggest/jquery.autoSuggest.js 
 * for compatibility
 */

elgg_register_event_handler('init', 'system', 'typeaheadtags_init');

function typeaheadtags_init() {
	global $CONFIG;
	
	// Register typeaheadtags JS
	$typeahead_js = elgg_get_simplecache_url('js', 'typeaheadtags/typeaheadtags');
	elgg_register_js('elgg.typeaheadtags', $typeahead_js);
	
	// Register simplecache view for autosuggest
	elgg_register_simplecache_view('js/typeaheadtags/autosuggest');
	
	// Register JS for autosuggest
	$autosuggest_js = elgg_get_simplecache_url('js', 'typeaheadtags/autosuggest');
	elgg_register_js('autosuggest', $autosuggest_js);
	
	// Register CSS for autosuggest
	$css_path = elgg_get_site_url();
	$autosuggest_css = "{$css_path}mod/typeaheadtags/vendors/autosuggest/autoSuggest.css";
	elgg_register_css('autosuggest', $autosuggest_css);
	
	// CSS 
	elgg_extend_view('css/elgg', 'typeaheadtags/css');
	
	// Register for view plugin hook 
	elgg_register_plugin_hook_handler('view', 'input/tags', 'typeaheadtags_input_handler');
	
	// Page handler for tags search endpoint
	elgg_register_page_handler('typeaheadtags', 'typeaheadtags_page_handler');

	return true;
}

/**
 * Page handler for typeahead tags
 */
function typeaheadtags_page_handler($page) {
	$q = get_input('q');
		
	// Only grab tags similar to the input
	$wheres[] = "msv.string like '%$q%'";	
			
	// Get site tags
	$site_tags = elgg_get_tags(array(
		'threshold' => 0, 
		'limit' => 99999,
		'wheres' => $wheres,
	));

	$tags_array = array();
	foreach ($site_tags as $site_tag) {
		$tag = array();
		$tag['tag'] = $site_tag->tag;
		$tags_array[] = $tag;
	}
	
	echo json_encode($tags_array);
}

/**
 * Plugin hook handler to mess around with the tags input view
 *
 * @param sting  $hook   view
 * @param string $type   input/tags
 * @param mixed  $value  Value
 * @param mixed  $params Params
 *
 * @return array
 */
function typeaheadtags_input_handler($hook, $type, $value, $params) {
	elgg_load_js('autosuggest');
	elgg_load_css('autosuggest');
	elgg_load_js('elgg.typeaheadtags');
	return $value;
}


