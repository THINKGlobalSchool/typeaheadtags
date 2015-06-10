<?php
/**
 * TGS Theme Typeaheadtags CSS view
 *
 * @package TypeaheadTags
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Jeff Tilson
 * @copyright THINK Global School 2010
 * @link http://www.thinkglobalschool.com/
 *
 */
?>
ul.as-selections {
	list-style-type: none;
	padding: 4px 0 4px 4px;
	margin: 0;
	overflow: auto;
	
	border: 1px solid #ccc;
	color: #666;
	font: 120% Arial, Helvetica, sans-serif;
	padding: 5px;
	width: 100%;

	-webkit-border-radius: 5px !important;
	-moz-border-radius: 5px !important;
	border-radius: 5px !important;

	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

ul.as-selections:focus {
	border: solid 1px #91131E;
	color:#333;
}

ul.as-selections.loading {
	background-color: #eee;
}

ul.as-selections li {
	float: left;
	margin: 1px 4px 1px 0;
}

ul.as-selections li.as-selection-item {
	color: #2b3840;
	font-size: 13px;
	font-family: "Lucida Grande", arial, sans-serif;
	
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f4f4f4), to(#d5d5d5));
	background-image: -moz-linear-gradient(19% 75% 90deg,#D5D5D5, #f4f4f4);
	
	border: 1px solid #777;

	padding: 2px 7px 2px 10px;
	border-radius: 12px;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	box-shadow: 0 1px 1px #e4edf2;
	-webkit-box-shadow: 0 1px 1px #e4edf2;
	-moz-box-shadow: 0 1px 1px #e4edf2;
}

ul.as-selections li.as-selection-item:last-child {
	margin-left: 30px;
}

ul.as-selections li.as-selection-item a.as-close {
	float: right;
	margin: 1px 0 0 7px;
	padding: 0 2px;
	cursor: pointer;
	color: #333333;
	font-family: "Helvetica", helvetica, arial, sans-serif;
	font-size: 14px;
	font-weight: bold;
	text-shadow: 0 1px 1px #999999;
	-webkit-transition: color .1s ease-in;
}

ul.as-selections li.as-selection-item.blur {
	color: #666666;
	background-color: #f4f4f4;
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f4f4f4), to(#d5d5d5));
	background-image: -moz-linear-gradient(19% 75% 90deg,#D5D5D5, #f4f4f4);
	border-color: #bbb;
	border-top-color: #ccc;
	box-shadow: 0 1px 1px #e9e9e9;
	-webkit-box-shadow: 0 1px 1px #e9e9e9;
	-moz-box-shadow: 0 1px 1px #e9e9e9;
}

ul.as-selections li.as-selection-item.blur a.as-close {
	color: #999;
}

ul.as-selections li:hover.as-selection-item {
	color: #111111;
	background-color: #BBB;
	
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#D5D5D5), to(#b3b3b3));
	background-image: -moz-linear-gradient(19% 75% 90deg,#D5D5D5, #f4f4f4);
	
	border-color: #777;
}

ul.as-selections li:hover.as-selection-item a.as-close {
	color: #333333;
}

ul.as-selections li.as-selection-item.selected {

}

ul.as-selections li.as-selection-item a:hover.as-close {
	color: #333333;
}

ul.as-selections li.as-selection-item a:active.as-close {
	color: #333333;
}

ul.as-selections li.as-original {
	margin-left: 0;
}

ul.as-selections li.as-original input {
	border: none;
	outline: none;
	font-size: 12px;
	width: 120px;
	height: 23px;
	padding-top: 5px;
}

ul.as-selections li.as-original input:focus {
}

ul.as-list {
	position: absolute;
	list-style-type: none;
	margin: 2px 0 0 0;
	padding: 0;
	font-size: 14px;
	color: #000;
	font-family: "Lucida Grande", arial, sans-serif;
	background-color: #fff;
	background-color: rgba(255,255,255,0.95);
	z-index: 2;
	box-shadow: 0 2px 12px #222;
	-webkit-box-shadow: 0 2px 12px #222;
	-moz-box-shadow: 0 2px 12px #222;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
}

li.as-result-item, li.as-message {
	margin: 0 0 0 0;
	padding: 5px 12px;
	background-color: transparent;
	border: 1px solid #fff;
	border-bottom: 1px solid #ddd;
	cursor: pointer;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
}

li:first-child.as-result-item {
	margin: 0;
}

li.as-message {
	margin: 0;
	cursor: default;
}

li.as-result-item.active {
	background-color: #bbb;
	border-color: #666;
	color: #fff;
	text-shadow: 0 1px 2px #222222;
}

li.as-result-item em { 
	font-style: normal; 
	background: #444;  
	padding: 0 2px;
	color: #fff;
}

li.as-result-item.active em { 
	background: #333;
	color: #fff;
}

/* Webkit Hacks  */
@media screen and (-webkit-min-device-pixel-ratio:0) {	

	ul.as-selections li.as-selection-item {
		padding-top: 3px;
		padding-bottom: 3px;
	}
	ul.as-selections li.as-selection-item a.as-close {
		margin-top: -1px;
	}
	ul.as-selections li.as-original input {
		height: 19px;
	}
}

/* Opera Hacks  */
@media all and (-webkit-min-device-pixel-ratio:10000), not all and (-webkit-min-device-pixel-ratio:0) {
	ul.as-list {
		border: 1px solid #888;
	}
	ul.as-selections li.as-selection-item a.as-close {
		margin-left: 4px;
		margin-top: 0;
	}
}

/* IE Hacks  */
ul.as-list {
	border: 1px solid #888\9;
}
ul.as-selections li.as-selection-item a.as-close {
	margin-left: 4px\9;
	margin-top: 0\9;
}

/* Firefox 3.0 Hacks */
ul.as-list,  x:-moz-any-link, x:default { 
	border: 1px solid #888;
}
BODY:first-of-type ul.as-list, x:-moz-any-link, x:default { /* Target FF 3.5+ */
	border: none;
}
