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

// Get common tags from plugin settings
$tags = elgg_get_plugin_setting('defaulttags','typeaheadtags');

?>
//<script>
elgg.provide('elgg.typeaheadtags');

elgg.typeaheadtags.defaultTags = '<?php echo $tags; ?>';

// URL for tag search
elgg.typeaheadtags.tagsURL = elgg.get_site_url() + 'typeaheadtags/search';

elgg.typeaheadtags.init = function() {	
	
	// Init tooltips
	$('.typeaheadtag-tooltip').tipTip({
		delay           : 0,
		defaultPosition : 'right',
		fadeIn          : 25,
		fadeOut         : 300,
		edgeOffset      : 3
	});
	
	
	// Which object field to use for tags
	var objProp = "tag";
		
	// Loop over each tag input (possible there are more than one)
	$('.elgg-input-tags').each(function() {	
		// Don't re-init already initted tag inputs
		if (!$(this).data('typeaheadtags_initted')) {	
			$(this).data('typeaheadtags_initted', true);
			
			// Autosuggest options array
			var options = {
				preFill: $(this).val(), // Prefill with original value, if any
				minChars: 1,
				startText: "",
				neverSubmit: true,
				selectedItemProp: objProp, 
				searchObjProps: objProp,
				selectedValuesProp: objProp,
			}
			
			// Check for single select class
			if ($(this).hasClass('typeaheadtags-single-select')) {
				
				options['selectionLimit'] = 2; 
				//console.log(options);
			}
			
			// Set up autosuggest on each input
			$(this).autoSuggest(elgg.typeaheadtags.tagsURL, options);
		
			// Add help button
			$(this).closest('.as-selections').prepend("<li class='as-selection-item typeaheadtags-help-button'>?</li>");
		
			// Get hidden input id
			var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
		
			// Create help container
			$module = $(this).closest('.elgg-input-tags-parent').find('.typeaheadtags-module');
		
			$module
				.attr('name', hidden_id);
		}
	}); 

	$('.as-input').click(elgg.typeaheadtags.toggleHelp);
	
	// Hide help box when clicking outside element
	$('body').live('click', function(e) {
		if (!$(e.target).hasClass('as-input') 
			&& !$(e.target).hasClass('as-selections') 
			&& !$(e.target).hasClass('as-selection-item')
			&& !$(e.target).hasClass('typeaheadtags-add-tag')) 
		{
			var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
			$('.typeaheadtags-help-container').slideUp('fast');
			$('.typeaheadtags-help-container').data('isHelpShowing', false);
		}
	});
	
	// Prevent help box from firing click events unless we're adding a tag or closing
	$('.typeaheadtags-help-container').click(function(e){
		if (!$(e.target).hasClass('typeaheadtags-add-tag') 
			&& !$(e.target).hasClass('elgg-icon-delete')) 
		{
			e.stopPropagation();
		}
	});
	
	// Make help button clickable
	$('.typeaheadtags-help-button').live('click', elgg.typeaheadtags.toggleHelp);
	
	// Close button on tag help module
	$('a.typeaheadtags-help-close').live('click', function() {$(this).closest('.typeaheadtags-help-container').slideUp('fast');});
	
	// Make tags in the tag help box clickable
	$('a.typeaheadtags-add-tag').live('click', elgg.typeaheadtags.addTagFromLink);
	
	// Prevent form submit if a tag input is empty
	$('input.as-values').closest('form').submit(function(event){
		$form = $(this);
		if (!elgg.typeaheadtags.checkFormTags($form)) {
			event.preventDefault();
		}
	});
}


/**
 * Helper function to unbind events as needed
 */
elgg.typeaheadtags.destroy = function(e) {
	$('.typeaheadtags-help-button').die('click');
	$('a.typeaheadtags-add-tag').die('click');
	$('a.typeaheadtags-help-close').die('click');
}

/**
 * Show help div 
 */
elgg.typeaheadtags.toggleHelp = function(e) {
	e.preventDefault();	
	
	var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
	
	if ($(e.target).hasClass('typeaheadtags-help-button') && !$('div[name="' + hidden_id + '"]').data('isHelpShowing')) {
		$('div[name="' + hidden_id + '"]').slideDown('fast');
		$('div[name="' + hidden_id + '"]').data('isHelpShowing', true);
	} else {
		if (($(e.target).hasClass('as-input') || $(e.target).hasClass('as-selections'))) {
			$('div[name="' + hidden_id + '"]').slideDown('fast');
			$('div[name="' + hidden_id + '"]').data('isHelpShowing', true);
		} else {
			$('div[name="' + hidden_id + '"]').slideUp('fast');
			$('div[name="' + hidden_id + '"]').data('isHelpShowing', false);
		}
	}
}

/**
 * Add a tag to the tag input from a link
 */
elgg.typeaheadtags.addTagFromLink = function(e) {
	// Get the value input
	var values_input = $('input#' + $(this).closest('div.typeaheadtags-help-container').attr('name'));

	// This is the tag we'll be adding
	var name = $(this).html();

	elgg.typeaheadtags.addTag(name, values_input);
}

// Generic add tag function, need to supply tag content and input
elgg.typeaheadtags.addTag = function(tag, input) {
	// Add the tag to the value input
	input.val(input.val() + tag + ",");
	
	// Create item (the item to be displayed)
	var item = $('<li class="as-selection-item" id="as-selection-'+ tag +'"></li>').click(function(){
			// selectionClick callback, won't work in this context
			//opts.selectionClick.call(this, $(this));
			
			// Get selections container
			var selections_holder = $(input).closest('.as-selections');
			
			// Remove 'selected' class from all items
			selections_holder.children().removeClass("selected");
			
			// Add selected class to this item
			$(this).addClass("selected");
			
		}).mousedown(function(){
			//nothing..
		});

	// Create the close button
	var close = $('<a class="as-close">&times;</a>').click(function(){
			// Remove value
			input.val(input.val().replace(tag + ",", ""));
			
			// Remove the item
			item.remove();
			
			// selectionclick callback, won't work
			//opts.selectionRemoved.call(this, item);
			
			//input_focus = true;
			//input.focus();
			return false;
		});
		
	// Get the original li (weird name..)	
	var org_li = $(input).closest('.as-original');
		
	// Add the item before the original li, with the close button
	org_li.before(item.html(tag).prepend(close));	
}

/**
 * Check a form for valid tags
 */
 elgg.typeaheadtags.checkFormTags = function($form) {
 	// Need to ignore these ones
	var exceptions = ['skills', 'interests', 'suggested_tags', 'search', 'custom'];

	var error = false;

	// Check each input, excluding exceptions
	$form.find('input.as-values').each(function() {
		var name = $(this).attr('name');
		
		$(this).closest('.as-selections').removeClass('tag-error');
		
		if ($.inArray(name, exceptions) == -1) {
			var value = $(this).val();
			if (!value || $.trim(value) == ',') {
				error = true;
				$(this).closest('.as-selections').addClass('tag-error');
				elgg.register_error(elgg.echo('typeaheadtags:error:missingtags'));
			}
		}
	});

	// If we have an error, return false
	if (error) {
		return false;
	} else {
		return true;
	}
 }

 /**
  * Allow other plugins to trigger a hook to manually check forms for tags
  */
 elgg.typeaheadtags.checkTagsListener = function(hook, type, params, value) {
 	if (hook == 'checkTags' && type == 'typeaheadtags' && params.form) {
 		return elgg.typeaheadtags.checkFormTags(params.form);
 	}
 	return true;
 }

elgg.register_hook_handler('checkTags', 'typeaheadtags', elgg.typeaheadtags.checkTagsListener);
elgg.register_hook_handler('init', 'system', elgg.typeaheadtags.init);