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
 * OVERRIDES:
 * input/tags - to include default tags
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
	
	// Register simplecache views for tipTip
	elgg_register_simplecache_view('js/tiptip');
	elgg_register_simplecache_view('css/tiptip');
	
	// Register CSS for tiptip
	$t_css = elgg_get_simplecache_url('css', 'tiptip');
	elgg_register_simplecache_view('css/tiptip');
	elgg_register_css('jquery.tiptip', $t_css);
	
	// Register JS for tiptip
	$t_js = elgg_get_simplecache_url('js', 'tiptip');
	elgg_register_simplecache_view('js/tiptip');
	elgg_register_js('jquery.tiptip', $t_js, 'head', 501);
	
	// Register typeaheadtags JS
	$typeahead_js = elgg_get_simplecache_url('js', 'typeaheadtags/typeaheadtags');
	elgg_register_simplecache_view('js/typeaheadtags/typeaheadtags');
	elgg_register_js('elgg.typeaheadtags', $typeahead_js, 'head', 502);
	elgg_load_js('elgg.typeaheadtags');


	// Register JS for autosuggest
	$autosuggest_js = elgg_get_simplecache_url('js', 'typeaheadtags/autosuggest');
	elgg_register_simplecache_view('js/typeaheadtags/autosuggest');
	elgg_register_js('autosuggest', $autosuggest_js);
	elgg_load_js('autosuggest');
	
	// Allow default theme to be extended
	if (!elgg_view_exists('css/typeaheadtags/autosuggest')) {
		$css_path = elgg_get_site_url();
		$autosuggest_css = "{$css_path}mod/typeaheadtags/vendors/autosuggest/autoSuggest.css";
	} else {
		$autosuggest_css = elgg_get_simplecache_url('css', 'typeaheadtags/autosuggest');
		elgg_register_simplecache_view('css/typeaheadtags/autosuggest');
	}

	// Register Autosuggest CSS
	elgg_register_css('autosuggest', $autosuggest_css);
	elgg_load_css('autosuggest');
	
	// Load CSS
	$t_css = elgg_get_simplecache_url('css', 'typeaheadtags/css');
	elgg_register_simplecache_view('css/typeaheadtags/css');
	elgg_register_css('elgg.typeaheadtags', $t_css);
	elgg_load_css('elgg.typeaheadtags');
	
	// Register for tidypics inline tag edit hook
	elgg_register_plugin_hook_handler('inline_edit_tags', 'tidypics', 'typeaheadtags_tidypics_tag_edit_handler');
	
	// Page handler for tags search endpoint
	elgg_register_page_handler('typeaheadtags', 'typeaheadtags_page_handler');
	
	// Extend composer view to trigger JS
	elgg_extend_view('composer/extend', 'typeaheadtags/composer');

	return true;
}

/**
 * Page handler for typeahead tags
 */
function typeaheadtags_page_handler($page) {
	switch($page[0]) {
		// Tag search
		case 'search':
			//gatekeeper(); - Not sure if I need to prevent access..
			$q = get_input('q');

			// Only grab tags similar to the input
			$wheres[] = "msv.string like '%$q%'";	

			// Get site tags
			$site_tags = elgg_get_tags(array(
				'threshold' => 1, 
				'limit' => 15,
				'wheres' => $wheres,
			));

			$dbprefix = elgg_get_config('dbprefix');

			$tags_array = array();
			foreach ($site_tags as $site_tag) {
				$tag = array();
				$tag['tag'] = $site_tag->tag;
				$tags_array[] = $tag;
			}

			echo json_encode($tags_array);
			break;
		// Display tag help
		case 'help':
			echo elgg_view('typeaheadtags/tag_help');
			break;
	}
	return TRUE;
}

/**
 * Hook into tidypics inline tag edit handler to allow typeahead tags
 *
 * @param sting  $hook   Hook
 * @param string $type   Type
 * @param mixed  $value  Value
 * @param mixed  $params Params
 *
 * @return array
 */
function typeaheadtags_tidypics_tag_edit_handler($hook, $type, $value, $params) {
	return elgg_view('input/tags', array(
		'name' => '_tp_edit_inline_tags',
		'value' => $params['image']->tags,
		'disable_help' => TRUE,
		'class' => 'tidypics-lightbox-edit-tags hidden',
	));
}


