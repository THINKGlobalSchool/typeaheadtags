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

li.typeaheadtags-help-button {
	font-weight: bold;
}

li.typeaheadtags-help-button:hover {
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

div.typeaheadtags-module {
	margin-top: 5px;
}

div.typeaheadtags-module .elgg-body {
	overflow: visible;
}

div.typeaheadtags-module-standard {
	float: left;
	width: 45%;
}

div.typeaheadtags-module-help {
	float: right;
	width: 45%;
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

/* Tag Error */

.tag-error {
	border: 3px solid Red !important;
}