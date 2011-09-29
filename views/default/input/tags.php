<?php
/**
 * Elgg tag input
 * Displays a tag input field
 *
 * @uses $vars['disabled']
 * @uses $vars['class']    Additional CSS class
 * @uses $vars['value']    Array of tags or a string
 * @uses $vars['entity']   Optional. Entity whose tags are being displayed (metadata ->tags)
 */

if (isset($vars['class'])) {
	$vars['class'] = "elgg-input-tags {$vars['class']}";
} else {
	$vars['class'] = "elgg-input-tags";
}

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


if (!isset($vars['value']) || empty($vars['value'])) {
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
echo elgg_view('typeaheadtags/tag_help');
?>
</div>