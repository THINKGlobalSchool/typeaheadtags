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


	echo "<script type='text/javascript'>
			function addTag(text, uid) {
				$('.typeaheadtags_' + uid).val($('.typeaheadtags_' + uid).val() + text + ', ');
			}
		</script>
	";

	echo "<h3>" . elgg_echo('typeaheadtags:label:help') . "</h3><hr />";
	echo "<table id='tags_list'>";
	foreach ($tags_array as $name => $desc) {
		echo "<tr><td style='width: 38%;'><span class='tag_name'><a class='fix_cursor' onclick='javascript:addTag(\"$name\", \"$uid\");'>$name</a></span></td><td style='width: 62%;'>$desc</td></tr>";
	}
	echo "</table>";
	
	echo "<div id='top_tags'><table><h3>" . elgg_echo('typeaheadtags:label:toptags') . "</h3>";
	foreach ($top_tags_data as $top_tag) {
		echo "<tr><td><span class='tag_name'><a class='fix_cursor' onclick='javascript:addTag(\"$top_tag->tag\", \"$uid\");'>$top_tag->tag</a></span></td></tr>";
	}
	echo "</table></div>";
?>