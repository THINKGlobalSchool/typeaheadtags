<?php
/**
 * Typeahead Tags Help
 * 
 * @package Typeahead Tags
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010 - 2015
 * @link http://www.thinkglobalschool.org/
 */

elgg_load_js('jquery.tiptip');
elgg_load_css('jquery.tiptip');

// Get common tags from plugin settings
$tags = elgg_get_plugin_setting('commontags','typeaheadtags');
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
$title .= '<a class="typeaheadtags-help-close"><span class="elgg-icon elgg-icon-delete float-right"></span></a>';

$content .= "<script type='text/javascript'>
		function addTag(text, uid) {
			$('.typeaheadtags_' + uid).val($('.typeaheadtags_' + uid).val() + text + ', ');
		}
	</script>
";

$standard_content .= "<div style='width: 100%;'><ul>";
foreach ($tags_array as $name => $desc) {
	$standard_content .= "<li style='float: left; width: 49%;'><span class='tag-name'><a title='$desc' class='typeaheadtag-tooltip typeaheadtags-add-tag'>$name</a></span></li>";
}
$standard_content .= "</ul><br style='clear: left;' /></div>";

$standard_title = elgg_echo('typeaheadtags:label:standardtitle');

$content .= elgg_view_module('aside', $standard_title, $standard_content, array('class' => 'typeaheadtags-module-standard'));

$top_title = elgg_echo('typeaheadtags:label:toptags');
$top_content .= "<div style='width: 100%;'><ul>";
foreach ($top_tags_data as $top_tag) {
	$top_content .= "<li style='float: left; width: 49%;'><span class='tag-name'><a class='typeaheadtags-add-tag'>$top_tag->tag</a></span></li>";
}
$top_content .= "</ul><br style='clear: left;' /></div>";

$content .= elgg_view_module('aside', $top_title, $top_content, array('class' => 'typeaheadtags-module-standard'));

echo elgg_view_module('featured', $title, $content, array('class' => 'typeaheadtags-help-container clearfix hidden typeaheadtags-module'));
