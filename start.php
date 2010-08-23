<?php
	/**
	 * Typeahead Tags Start
	 * 
	 * @package Typeahead Tags
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * typeaheadtags
	 */
	
	function typeaheadtags_init() {
		global $CONFIG;
		
		// CSS 
		elgg_extend_view('css', 'typeaheadtags/css');

		
		return true;
	}
	

	register_elgg_event_handler('init', 'system', 'typeaheadtags_init');
?>