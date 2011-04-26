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
<p>
	<label><?php echo elgg_echo('typeaheadtags:label:commontags'); ?></label><br /><br />
	<?php echo elgg_echo('typeaheadtags:text:commontagssettings'); ?><br />
	<?php 
	echo elgg_view('input/plaintext', array(
										'internalname' => 'params[commontags]', 
										'value' => $vars['entity']->commontags)
										); 
	?>
</p>
<p>
	<label><?php echo elgg_echo('typeaheadtags:label:jobs'); ?></label><br /><br />
	<?php echo elgg_echo('typeaheadtags:text:commontagssettings'); ?><br />
	<?php 
	echo elgg_view('input/plaintext', array(
										'internalname' => 'params[jobs]', 
										'value' => $vars['entity']->jobs)
										); 
	?>
</p>
<p>
	<label><?php echo elgg_echo('typeaheadtags:label:boxheight'); ?></label><br />
	<?php 
	echo elgg_view('input/text', array(
										'internalname' => 'params[boxheight]', 
										'value' => $vars['entity']->boxheight,
										'class' => 'shortbox'
										)); 
	?>
</p>
<p>
	<label><?php echo elgg_echo('typeaheadtags:label:boxwidth'); ?></label><br />
	<?php 
	echo elgg_view('input/text', array(
										'internalname' => 'params[boxwidth]', 
										'value' => $vars['entity']->boxwidth,
										'class' => 'shortbox'
										)); 
	?>
</p>