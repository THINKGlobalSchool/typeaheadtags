<?php
/**
 * Typeahead Tags Settings form
 * 
 * @package Typeahead Tags
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 * 
 */
?>
<br />
<p>
	<label><?php echo elgg_echo('typeaheadtags:label:commontags'); ?></label><br />
	<?php echo elgg_echo('typeaheadtags:text:commontagssettings'); ?><br />
	<?php 
	echo elgg_view('input/plaintext', array(
										'internalname' => 'params[commontags]', 
										'value' => $vars['entity']->commontags)
										); 
	?>
</p>
<p>
	<label><?php echo elgg_echo('typeaheadtags:label:defaulttags'); ?></label><br /><br />
	<?php 
	echo elgg_view('input/text', array(
										'internalname' => 'params[defaulttags]', 
										'value' => $vars['entity']->defaulttags)
										); 
	?>
</p>