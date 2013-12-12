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

elgg.typeaheadtags.help_enabled = false;

elgg.typeaheadtags.init = function() {

	$(window).scroll(function(){
		$help = $('.typeaheadtags-help-container');	
		if ($help.is(':visible') && $help.parent().find('[data-hoverHelp="1"]').length) {
			$help.position({
				my: 'right top',
				at: 'right bottom',
				of: $help.parent(),
				collision: 'none none'
			});
		}
	});
	
	if (typeof(tipTip) !== 'undefined') {
		// Init tooltips
		$('.typeaheadtag-tooltip').tipTip({
			delay           : 0,
			defaultPosition : 'right',
			fadeIn          : 25,
			fadeOut         : 300,
			edgeOffset      : 3
		});
	}
	
	// Which object field to use for tags
	var objProp = "tag";
		
	// Loop over each tag input (possible there are more than one)
	$('.elgg-input-tags').each(function() {	
		// Don't re-init already initted tag inputs
		if (!$(this).data('typeaheadtags_initted')) {	
			$(this).data('typeaheadtags_initted', true);

			var $_this = $(this);
			
			// Autosuggest options array
			var options = {
				preFill: $(this).val(), // Prefill with original value, if any
				minChars: 1,
				startText: "",
				neverSubmit: true,
				selectedItemProp: objProp, 
				searchObjProps: objProp,
				selectedValuesProp: objProp,
				// Add hooks for add/remove events
				selectionAdded: function(elem) {
					elgg.trigger_hook('selection_added', 'typeaheadtags', {'input': $_this}, elem);
					return true;
				},
				selectionRemoved: function(elem) {
					elgg.trigger_hook('selection_removed', 'typeaheadtags', {'input': $_this}, elem);
					elem.remove();
				}
			}
			
			// Check for single select class
			if ($(this).hasClass('typeaheadtags-single-select')) {
				
				options['selectionLimit'] = 2; 
				//console.log(options);
			}
			
			// Set up autosuggest on each input
			$(this).autoSuggest(elgg.typeaheadtags.tagsURL, options);
		
			// Add help button if enabled
			if (elgg.typeaheadtags.help_enabled) {
				$(this).closest('.as-selections').prepend("<li class='as-selection-item typeaheadtags-help-button'>?</li>");

				// Get hidden input id
				var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
			
				// Create help container
				$module = $(this).closest('.elgg-input-tags-parent').find('.typeaheadtags-module');
			
				$module
					.attr('name', hidden_id);
			}
		}
	}); 
	
	// Bind click event for typeahead tags inputs
	$('.as-input').live('click', elgg.typeaheadtags.toggleHelp);
	
	// Hide help box when clicking outside element
	$('body').live('click', elgg.typeaheadtags.toggleHelp);
	
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
	$('a.typeaheadtags-help-close').live('click', elgg.typeaheadtags.toggleHelp);
	
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
	$('.elgg-input-tags').die();
}


/**
 * Show help div 
 */
elgg.typeaheadtags.toggleHelp = function(event) {
	// Find the help container id
	var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
	
	// Get the help container
	var $help = $('div[name="' + hidden_id + '"]');

	var $parent = $help.parent();

	if (($(event.target).hasClass('typeaheadtags-help-button') && !$help.data('isHelpShowing'))
		|| ($(event.target).hasClass('as-input') || $(event.target).hasClass('as-selections'))) {
		if ($help.length) {
			// Hide any other help containers
			$('.typeaheadtags-help-container').fadeOut('fast');
			$help.data('isHelpShowing', true);
			if ($parent.find('[data-hoverHelp="1"]').length) {
				var options = {
					my: 'right top',
					at: 'right bottom',
					of: $parent,
					collision: 'none none'
				}

				$help.css({
					'position': 'fixed',
					'z-index': 8000
				}).slideDown('fast').position(options);
			} else {
				$help.slideDown('fast');
			}

			
		}
	} else {
		if (!$help.length) {
			$help = $('.typeaheadtags-help-container');
		}
		$help.data('isHelpShowing', false);
		$help.slideUp('fast');
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
			elgg.trigger_hook('selection_removed', 'typeaheadtags', {'input': input}, item);
			
			//input_focus = true;
			//input.focus();
			return false;
		});
		
	// Get the original li (weird name..)	


	var org_li = $(input).closest('.as-original');
		
	// Add the item before the original li, with the close button
	org_li.before(item.html(tag).prepend(close));

	elgg.trigger_hook('selection_added', 'typeaheadtags', {'input': input}, item);
}

/**
 * Check a form for valid tags
 */
 elgg.typeaheadtags.checkFormTags = function($form) {
 	// Need to ignore these ones
	var exceptions = ['skills', 'interests', 'suggested_tags', 'search', 'custom', 'categories'];

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

/**
 * Hook into tidypics inline tag edit show to set up typeaheadtags
 */
elgg.typeaheadtags.tidypicsTagEditShow = function(hook, type, params, value) {
	if (params.input && params.input.attr('name') == '_tp_edit_inline_tags') {
		elgg.typeaheadtags.init();
		// Show the tagging parent container
		$('._tp-can-edit .elgg-input-tags-parent').show();

		// Remove position static to fix results positioning
		$('.tidypics-lightbox-photo-tags').css('position', 'static');

		// Show and focus the tag input
		$('._tp-can-edit .elgg-input-tags-parent input[name=_tp_edit_inline_tags-orig]').show().focus();
	}
	return value;
}

/**
 * Hook into tidypics inline tag edit hide to handle hiding the typeaheadtags input
 */
elgg.typeaheadtags.tidypicsTagEditHide = function(hook, type, params, value) {
	if (params.input && params.input.attr('name').indexOf('_tp_edit_inline_tags') == 0) {
		// Restore relative positioning
		$('.tidypics-lightbox-photo-tags').css('position', 'relative');

		// Hide the tagging parent container
		$('._tp-can-edit .elgg-input-tags-parent').hide();
	}
	return value;
}

/**
 * Hook into tidypics inline tag edit to get the typeaheadtags value
 */
elgg.typeaheadtags.tidypicsTagGetValue = function(hook, type, params, value) {
	if (params.input && params.input.attr('name').indexOf('_tp_edit_inline_tags') == 0) {
		var value = $('input[name=_tp_edit_inline_tags]').val();
		if (!value) {
			elgg.register_error(elgg.echo('typeaheadtags:error:missingtags'));
		}
		return value;
	}	
	return true;
}

elgg.register_hook_handler('checkTags', 'typeaheadtags', elgg.typeaheadtags.checkTagsListener);
elgg.register_hook_handler('init', 'system', elgg.typeaheadtags.init);
elgg.register_hook_handler('photoLightboxInlineEditInputShow', 'tidypics', elgg.typeaheadtags.tidypicsTagEditShow);
elgg.register_hook_handler('photoLightboxInlineEditInputHide', 'tidypics', elgg.typeaheadtags.tidypicsTagEditHide);
elgg.register_hook_handler('photoLightboxInlineEditGetValue', 'tidypics', elgg.typeaheadtags.tidypicsTagGetValue);