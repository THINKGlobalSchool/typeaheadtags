<?php
	/**
	 * Typeahead Tags CSS
	 * 
	 * @package Typeahead Tags
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Jeff Tilson
	 * @copyright THINK Global School 2010
	 * @link http://www.thinkglobalschool.com/
	 * 
	 */
?>

input.tt {
	position: absolute;
	top: 0px;
	left: 30px;
	width: 450px;
}

span.tags_help {
	position: absolute;
	top: 0px;
	bottom: 0px;
	background-image:url(<?php echo $vars['url']; ?>mod/typeaheadtags/images/tag_help.png);
	height: 29px;
	width: 29px;
	display: inline-block;
}

span.tags_help:hover {
	cursor: pointer;
}

div.tags_help_div {
	position: absolute;
	display: none;
	width: <?php echo get_plugin_setting('boxwidth','typeaheadtags'); ?>px;
	height: <?php echo get_plugin_setting('boxheight','typeaheadtags'); ?>px;
	border: 1px solid #999;
	-moz-box-shadow: 5px 5px 13px #333;
	-webkit-box-shadow: 5px 5px 13px #333;
	box-shadow: 5px 5px 13px #333;
	background: #eee;
	padding: 5px;
	left: 40px;
	top: -<?php echo ((int)get_plugin_setting('boxheight','typeaheadtags') +20); ?>px;
	overflow: hidden;
	z-index: 7001;
}

table#tags_list {
	font-size: 80%;
	float: left;
	width: 405px;
}

div#top_tags {
	float: right;
	border: 1px solid #bbb;
	padding: 7px;
	width: 150px;
	margin-right: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-moz-box-shadow: 2px 2px 2px #666;
	-webkit-box-shadow: 2px 2px 2px #666;
	background: #fff;
}

div#top_tags table {
	font-size: 90%;
}

div#top_tags h3 {
	padding-bottom: 4px;
}

span.close_btn {
	float: right;
}

span.close_btn a:hover {
	cursor: pointer;
}

input.shortbox {
	width: 200px;
}

.tidypics_edit_image_container {
	overflow: visible;
	height: 300px;
	clear: both;
}
