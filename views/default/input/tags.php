<?php
	/**
	 * Typeahead tags input
	 *
	 * @package Typeahead Tags
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 *
	 * @uses $vars['value'] The current value, if any - string or array - tags will be encoded
	 * @uses $vars['js'] Any Javascript to enter into the input tag
	 * @uses $vars['internalname'] The name of the input field
	 * @uses $vars['internalid'] The id of the input field
	 * @uses $vars['class'] CSS class override
	 * @uses $vars['disabled'] Is the input field disabled?
	 */
	
	// Get site tags
	$site_tags = elgg_get_tags(array(threshold=>0, limit=>100));
	$tags_array = array();
	foreach ($site_tags as $site_tag) {
		$tags_array[] = $site_tag->tag;
	}
	
	$tags_array = json_encode($tags_array);
	
	$uid = uniqid(); // For multiple text boxes

	$class = "input_tags typeaheadtags_$uid tt";
	if (isset($vars['class'])) {
		$class = $vars['class'] . " typeaheadtags_$uid tt";
	}

	$disabled = false;
	if (isset($vars['disabled'])) {
		$disabled = $vars['disabled'];
	}

	if (!isset($vars['value']) || $vars['value'] === FALSE) {
		$vars['value'] = elgg_get_sticky_value($vars['internalname']);
	}

	$tags = "";
	if (!empty($vars['value'])) {
		if (is_array($vars['value'])) {
			foreach($vars['value'] as $tag) {

				if (!empty($tags)) {
					$tags .= ", ";
				}
				if (is_string($tag)) {
					$tags .= $tag;
				} else {
					$tags .= $tag->value;
				}
			}
		} else {
			$tags = $vars['value'];
		}
	}
?>
<br />	
<div style='position: relative;'>
	<span id='toggle_div_<?php echo $uid; ?>' class="tags_help" alt="Help" style='position: relative;'></span>
	<div id='help_div_<?php echo $uid; ?>' class='tags_help_div'><span id='tag_help_close_<?php echo $uid; ?>' class='close_btn'><a>[Close]</a></span><?php echo elgg_view('typeaheadtags/tag_help', array('uid' => $uid)); ?></div>
	<input 	type="text" <?php if ($disabled) echo ' disabled="yes" '; ?><?php echo $vars['js']; ?> 
			name="<?php echo $vars['internalname']; ?>" <?php if (isset($vars['internalid'])) echo "id=\"{$vars['internalid']}\""; ?> 
			value="<?php echo htmlentities($tags, ENT_QUOTES, 'UTF-8'); ?>" 
			class="<?php echo $class; ?>"
	/>
</div>
<script language="javascript" type="text/javascript" src="<?php echo $vars['url']; ?>vendors/jquery/jquery.autocomplete.min.js"></script>
<script type='text/javascript'>


	$(document).ready(function () {
		
		var data = $.parseJSON('<?php echo $tags_array;?>');
		$(".typeaheadtags_<?php echo $uid; ?>").autocomplete(data, {
										highlight: false,
										multiple: true,
										multipleSeparator: ", ",
										scroll: true,
										scrollHeight: 300
		});
		
		var in_help_box = false;
	
		$('span#toggle_div_<?php echo $uid; ?>').click(
			function() {
				$('div#help_div_<?php echo $uid; ?>').toggle();
			}
		);
		
		$('#tag_help_close_<?php echo $uid; ?>').click(
			function() {
				$('div#help_div_<?php echo $uid; ?>').toggle();
			}
		);
		
		$('#help_div_<?php echo $uid; ?>').hover(function(){ 
		        in_help_box = true; 
		    }, function(){ 
		        in_help_box = false; 
		});
		
		$('span#toggle_div_<?php echo $uid; ?>').hover(function(){ 
		        in_help_box = true; 
		    }, function(){ 
		        in_help_box = false; 
		});

		$('body').mouseup(function(){ 
			if(!in_help_box) {
				$('div#help_div_<?php echo $uid; ?>').hide();
			}
		});		
	});
</script>