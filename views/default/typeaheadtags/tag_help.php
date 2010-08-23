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
	$tags = explode("\n", $tags);
	$tags_array = array();
	foreach ($tags as $idx => $tag) {
		$tags[$idx] = explode("-", $tag);
		foreach ($tags[$idx] as $key => $info) {
				$tags[$idx][$key]= trim($info);
		}
		$tags_array[$tags[$idx][0]] = $tags[$idx][1]; 
	}

	echo "<h3>" . elgg_echo('typeaheadtags:label:help') . "</h3><hr />";
	echo "<table id='tags_list'>";
	foreach ($tags_array as $name => $desc) {
		echo "<tr><td style='width: 40%;'><span class='tag_name'>$name</span></td><td>$desc</td></tr>";
	}
	echo "</table>";
?>