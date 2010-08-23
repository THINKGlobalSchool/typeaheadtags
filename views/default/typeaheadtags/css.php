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

input.typeaheadtags {
	position: absolute;
	top: 0px;
	left: 30px;
	width: 450px;
}

span#tags_help {
	position: absolute;
	top: 0px;
	bottom: 0px;
	background-image:url(<?php echo $vars['url']; ?>mod/typeaheadtags/images/tag_help.png);
	height: 29px;
	width: 29px;
	display: inline-block;
}

div#tags_help_div {
	position: absolute;
	display: none;
	width: 350px;
	height: 150px;
	border: 1px solid #999;
	-moz-box-shadow: 5px 5px 13px #333;
	-webkit-box-shadow: 5px 5px 13px #333;
	box-shadow: 5px 5px 13px #333;
	background: #eee;
	padding: 5px;
	left: 40px;
	top: -170px;
}