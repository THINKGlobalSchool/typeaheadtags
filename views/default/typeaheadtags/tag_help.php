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
	
	// Unique ID
	$uid = $vars['uid'];

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
	
	$jobs = get_plugin_setting('jobs', 'typeaheadtags');
	$jobs = explode("\n", $jobs);
	$jobs_array = array();
	foreach($jobs as $idx => $job) {
		$jobs[$idx] = explode("-", $job);
		foreach ($jobs[$idx] as $key => $info) {
				$jobs[$idx][$key]= trim($info);
		}
		$jobs_array[$jobs[$idx][0]] = $jobs[$idx][1];
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
		echo "<tr>
				<td>
					<span class='tag-name'>
						<a onclick='javascript:addTag(\"$name\", \"$uid\");'>$name</a>
						<span class='tag-description'>
							$desc
						</span>
					</span>
				</td>
			</tr>";
	}
	echo "</table>";
		
	echo "<div id='top-tags'><table><h3>" . elgg_echo('typeaheadtags:label:toptags') . "</h3>";
	foreach ($top_tags_data as $top_tag) {
		echo "<tr><td><span class='tag-name'><a class='fix_cursor' onclick='javascript:addTag(\"$top_tag->tag\", \"$uid\");'>$top_tag->tag</a></span></td></tr>";
	}
	echo "</table></div>";
	
	echo "<div id='top-tags'><table><h3>" . elgg_echo('typeaheadtags:label:jobs') . "</h3>";
	foreach ($jobs_array as $tag => $desc) {
		echo "<tr>
				<td>
					<span class='tag-name'>
						<a onclick='javascript:addTag(\"$tag\", \"$uid\");'>$tag</a>
						<span class='tag-description'>
							$desc
						</span>
					</span>
				</td>
			</tr>";
	}
	echo "</table></div>";

?>