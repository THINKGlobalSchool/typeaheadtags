<?php
/**
 * Elgg tag input
 * Displays a tag input field
 *
 * @uses $vars['disabled']
 * @uses $vars['class']         Additional CSS class
 * @uses $vars['value']         Array of tags or a string
 * @uses $vars['entity']        Optional. Entity whose tags are being displayed (metadata ->tags)
 * @uses $vars['disable_help']  Optional. Disable tag help
 */

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-tags {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-tags";
}

$disable_help = elgg_extract('disable_help', $vars, FALSE);

$default_tags = string_to_tag_array(elgg_get_plugin_setting('defaulttags','typeaheadtags'));

$defaults = array(
	'value' => '',
	'disabled' => false,
);

if (isset($vars['entity'])) {
	$defaults['value'] = $vars['entity']->tags;
	unset($vars['entity']);
} 

$vars = array_merge($defaults, $vars);

// Default tag exceptions
$exceptions = array(
	'skills', 
	'interests', 
	'suggested_tags',
	'custom',
	'photos-listing-tag',
	'categories'
);

// @TODO use this everywhere :D
$exceptions = elgg_trigger_plugin_hook('get_exceptions', 'typeaheadtags', null, $exceptions);

if (!in_array($vars['name'], $exceptions) && (!isset($vars['value']) || empty($vars['value']))) {
	$vars['value'] = $default_tags;
}

if (is_array($vars['value'])) {
	$tags = array();

	foreach ($vars['value'] as $tag) {
		if (is_string($tag)) {
			$tags[] = $tag;
		} else {
			$tags[] = $tag->value;
		}
	}

	$vars['value'] = implode(", ", $tags);
}

?>
<div class='elgg-input-tags-parent'>
<input type="text" <?php echo elgg_format_attributes($vars); ?> />
<?php
if (!$disable_help) {
	echo elgg_view('typeaheadtags/tag_help');
	echo "<script type='text/javascript'>
		elgg.typeaheadtags.help_enabled = true;
	</script>";
}
?>
</div>