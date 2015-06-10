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
	border-color: #444 !important;
	cursor: pointer;
}

li.typeaheadtags-help-button, li.typeaheadtags-help-button.blur {
	padding: 2px 7px 2px 8px !important;
	color: #FFFFFF !important;	
	background: #bbb !important;
	border-color: #666666 !important;
	border-top-color: #666666 !important;
}

li.typeaheadtags-help-button:hover {
	cursor: pointer;
	background: #999 !important;
}

div.typeaheadtags-help-container {
	margin-top: 5px;
	display: none;
	background: #FFFFFF;
	border: 1px solid #AAA;
	box-shadow: 1px 1px 2px #777;
	max-width: 754px;
	padding: 0;
}

.as-results {
	position: relative;
	z-index: 8001;
}

table#typeaheadtags-tags-list {
	float: left;
	width: 30%;
}

div.typeaheadtags-module .elgg-body {
	overflow: visible;
}

div.typeaheadtags-module-standard {
	float: left;
	width: 48%;
	margin-right: 1%;
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

.elgg-input-tags-parent .as-selections {
	background: #FFFFFF;
}

span.tag-name a:hover {
	cursor: pointer;
}

.tag-error {
	border: 3px solid Red !important;
}

._tp-can-edit .elgg-input-tags-parent {
	display: none;
}

/* Tidypics lightbox CSS */
.tidypics-lightbox-container .tidypics-lightbox-edit-tags {
	margin-top: 0;
	margin-bottom: 0;
}

.tidypics-lightbox-photo-tags._tp-can-edit .elgg-input-tags-parent {
	margin-bottom: 7px;
	margin-top: 3px;
}