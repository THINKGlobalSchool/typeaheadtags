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

li.typeaheadtags-help-button  span {
	font-weight: bold;
}

li.typeaheadtags-help-button  span:hover {
	cursor: pointer;
}

li.typeaheadtags-help-button, li.typeaheadtags-help-button.blur {
	padding: 2px 7px 2px 8px !important;
	color: #2b3840 !important;
	background-color: #bbd4f1 !important;
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#bbd4f1), to(#a3c2e5)) !important;
	border-color: #6da0e0 !important;
	border-top-color: #8bb7ed !important;
}

li.typeaheadtags-help-button:hover {
	cursor: pointer;
}

div.typeaheadtags-help-container {
	margin-top: 5px;
	display: none;
}

table#typeaheadtags-tags-list {
	float: left;
	width: 30%;
}

div.typeaheadtags-module .elgg-body {
	overflow: visible;
}

div.typeaheadtags-module-help {
	float: right;
	width: 200px;
	margin-right: 5px;
}

div#typeaheadtags-module-help table {
	font-size: 90%;
}

div#typeaheadtags-module-help h3 {
	padding-bottom: 4px;
}

a.typeaheadtags-help-close:hover {
	cursor: pointer;
}

span.tag-name a:hover {
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
