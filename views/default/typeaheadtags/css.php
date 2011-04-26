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
	overflow: show;
	z-index: 7000;
}

table#tags_list {
	font-size: 80%;
	float: left;
	width: auto;
}

div#top-tags {
	float: right;
	border: 1px solid #bbb;
	padding: 7px;
	width: auto;
	min-width: 150px;
	margin-right: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-moz-box-shadow: 2px 2px 2px #666;
	-webkit-box-shadow: 2px 2px 2px #666;
	background: #fff;
}

div#top-tags table {
	font-size: 90%;
}

div#top-tags h3 {
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

a.fix_cursor:hover {
	cursor: pointer;
}

/* Tooltips */

span.tag-name {
	position: relative;   /* this is key */
 	//cursor: help;
}

span.tag-name span.tag-description {
	display: none;        /* so is this */
}

span.tag-name:hover {
	cursor: help;
}

span.tag-name:hover span.tag-description {
	font-weight: bold;
	display: block;
	z-index: 7001;
	position: absolute;
	top: 2em;
	left: 25px;
	width: auto;
	min-width: 90px;
	padding: 3px 7px 4px 6px;
	border: 1px solid #777;
	background-color: #ffffff;
	text-align: left;
	color: #000;
}