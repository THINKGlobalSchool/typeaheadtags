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

// URL for tag help box
elgg.typeaheadtags.helpURL = elgg.get_site_url() + 'typeaheadtags/help';

elgg.typeaheadtags.init = function() {	
	// Which object field to use for tags
	var objProp = "tag";
		
	// Loop over each tag input (possible there are more than one)
	$('.elgg-input-tags').each(function() {
		
		// Set up autosuggest on each input
		$(this).autoSuggest(elgg.typeaheadtags.tagsURL, 
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
		
		// Add help button
		$(this).closest('.as-selections').prepend("<li class='as-selection-item typeaheadtags-help-button'><span>?</span></li>");
		
		// Get hidden input id
		var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
		
		// Create help container
		$(this).closest('.as-selections').after("<div name='" + hidden_id + "' class='typeaheadtags-help-container clearfix'></div>");
	}); 

	$('.as-selections').focus(elgg.typeaheadtags.showHelp);
	
	// Make help button clickable
	$('.typeaheadtags-help-button').live('click', elgg.typeaheadtags.toggleHelp);

	
	// Close button on tag help module
	$('a.typeaheadtags-help-close').live('click', function() {$(this).closest('.typeaheadtags-help-container').slideToggle('fast');});
	
	// Make tags in the tag help box clickable
	$('a.typeaheadtags-add-tag').live('click', elgg.typeaheadtags.addTag);
	
	// Need to ignore these ones
	var exceptions = ['skills', 'interests'];
	
	// Prevent form submit if a tag input is empty
	$('input.as-values').closest('form').submit(function(event){
		// Check each input, excluding exceptions
		$('input.as-values').each(function() {
			var name = $(this).attr('name');
			
			$(this).closest('.as-selections').removeClass('tag-error');
			
			if ($.inArray(name, exceptions) == -1) {
				console.log($(this));
				var value = $(this).val();
				if (!value || $.trim(value) == ',') {
					event.preventDefault();
					$(this).closest('.as-selections').addClass('tag-error');
					elgg.register_error(elgg.echo('typeaheadtags:error:missingtags'));
				}
			}
		});
	});
	
	// Pre-fill with default tags
	$('input.as-values').each(function() {
		var name = $(this).attr('name');
	});
}

/**
 * Show help div 
 */
elgg.typeaheadtags.showHelp = function(e) {
	
	e.preventDefault();	
	var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
	
	if (e.type == 'focus' && !$('div[name="' + hidden_id + '"]').data('isHelpShowing')) {
		
		// Only load if empty
		if ($('div[name="' + hidden_id + '"]').is(':empty')) {
			$('div[name="' + hidden_id + '"]').load(elgg.typeaheadtags.helpURL, function() {
				$(this).slideToggle('fast');
			
				// Need to force the modules height due to setting overflow hidden
				var table = $('div[name="' + hidden_id + '"] table#typeaheadtags-tags-list');
				table.closest('div.elgg-body').height(table.height());
			});
		} else {
			$('div[name="' + hidden_id + '"]').slideDown('fast');
		}
		
		$('div[name="' + hidden_id + '"]').data('isHelpShowing', true);
	}
}

elgg.typeaheadtags.toggleHelp = function(e) {
	e.preventDefault();	
	var hidden_id = $(this).closest('.as-selections').find('input.as-values').attr('id');
	$('div[name="' + hidden_id + '"]').slideToggle('fast');	
}

/**
 * Programatically add an item to the as input
 * - This is a bit hacky as the original code doesn't easily allow 
 * adding items programatically. One issue is that the callback events
 * don't work (I'm not using them anyway)
 */
elgg.typeaheadtags.addTag = function(e) {
	// Get the value input
	var values_input = $('input#' + $(this).closest('div.typeaheadtags-help-container').attr('name'));

	// This is the tag we'll be adding
	var name = $(this).html();
	
	// Add the tag to the value input
	values_input.val(values_input.val() + name + ",");
	
	// Create item (the item to be displayed)
	var item = $('<li class="as-selection-item" id="as-selection-'+ name +'"></li>').click(function(){
			// selectionClick callback, won't work in this context
			//opts.selectionClick.call(this, $(this));
			
			// Get selections container
			var selections_holder = $(values_input).closest('.as-selections');
			
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
			values_input.val(values_input.val().replace(name + ",", ""));
			
			// Remove the item
			item.remove();
			
			// selectionclick callback, won't work
			//opts.selectionRemoved.call(this, item);
			
			//input_focus = true;
			//input.focus();
			return false;
		});
		
	// Get the original li (weird name..)	
	var org_li = $(values_input).closest('.as-original');
		
	// Add the item before the original li, with the close button
	org_li.before(item.html(name).prepend(close));
	
	// selectionAdded callback, also won't work
	//opts.selectionAdded.call(this, org_li.prev());	
}

elgg.register_hook_handler('init', 'system', elgg.typeaheadtags.init);
//</script>