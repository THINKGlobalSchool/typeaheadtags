<?php
/**
 * Typeahead Tags JS
 * 
 * @package Typeahead Tags
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */
?>
//<script>
elgg.provide('elgg.typeaheadtags');

// URL for tag data
elgg.typeaheadtags.url = elgg.get_site_url() + 'typeaheadtags';

elgg.typeaheadtags.init = function() {	
	var objProp = "tag";
	$('.elgg-input-tags').each(function() {
		$(this).autoSuggest(elgg.typeaheadtags.url, 
			{
				preFill: $(this).val(), // Prefill with original value, if any
				minChars: 1,
				startText: "",
				neverSubmit: true,
				selectedItemProp: objProp, 
				searchObjProps: objProp,
				selectedValuesProp: objProp,
			}
		);
	}); 
}

elgg.register_hook_handler('init', 'system', elgg.typeaheadtags.init);
//</script>