<?php
/**
 * Typeahead Tags Help
 * 
 * @package Typeahead Tags
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 */

// Get contacts from plugin settings
$tags = get_plugin_setting('commontags','typeaheadtags');
$uid = $vars['uid'];
$tags = explode("\n", $tags);
$tags_array = array();
foreach ($tags as $idx => $tag) {
	$tags[$idx] = explode("-", $tag);
	foreach ($tags[$idx] as $key => $info) {
			$tags[$idx][$key]= trim($info);
	}
	$tags_array[$tags[$idx][0]] = $tags[$idx][1]; 
}

$top_tags_data = elgg_get_tags(array('limit' => 11));

$title = elgg_echo('typeaheadtags:label:help');
$title .= '<a class="typeaheadtags-help-close"><span class="elgg-icon elgg-icon-delete right"></span></a>';

$content .= "<script type='text/javascript'>
		function addTag(text, uid) {
			$('.typeaheadtags_' + uid).val($('.typeaheadtags_' + uid).val() + text + ', ');
		}
	</script>
";

$content .= "<table id='typeaheadtags-tags-list'>";
foreach ($tags_array as $name => $desc) {
	$content .= "<tr><td style='width: 38%;'><span class='tag-name'><a class='typeaheadtags-add-tag'>$name</a></span></td><td style='width: 62%;'>$desc</td></tr>";
}
$content .= "</table>";

$top_title = elgg_echo('typeaheadtags:label:toptags');
$top_content .= "<table>";
foreach ($top_tags_data as $top_tag) {
	$top_content .= "<tr><td><span class='tag-name'><a class='typeaheadtags-add-tag'>$top_tag->tag</a></span></td></tr>";
}
$top_content .= "</table>";

$top_module = elgg_view_module('aside', $top_title, $top_content, $options);

$content .= "<div id='typeaheadtags-top-tags'>";
$content .= $top_module;
$content .= "</div>";

echo elgg_view_module('featured', $title, $content, $options);
