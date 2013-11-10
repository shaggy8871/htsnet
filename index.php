<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Evolia Closet - Flash to HTML</title>
		<!-- 
		Copyright (C) 2013, J. Ginsberg. All rights reserved.
		This code cannot be copied or distributed without the copyright holder's explicit permission
		-->
		<style>
			.outer {
				width: 969px;
				height: 648px;
				background-color: #eee;
				border: 1px solid #9e9e9e;
				border-right: none;
			}
			.tb {
				font-family: Arial;
				font-size: 14px;
				letter-spacing: -0.23px;
				font-weight: bold;
				text-align: center;
				border-bottom: 1px solid #000;
				border-right: 1px solid #9e9e9e;
			}
			.intro {
				padding: 3px;
				padding-top: 2px;
			}
			.slider {
				background-color: #2a7bb4;
			}
			.slider .inner {
				padding: 3px;
				padding-left: 4px;
				overflow: hidden;
			}
			.slider .items {
				float: left;
				height: 97px;
				width: 860px;
				background-color: #eaf2f8;
				border-radius: 5px;
			}
			.pics {
				float: left;
				width: 794px;
				height: 95px;
			}
			.pics ul {
				margin: 0;
				padding: 0;
				display: inline;
				overflow: hidden;
			}
			.tbgb {
				background: #f4f4f4; /* Old browsers */
				/* IE9 SVG, needs conditional override of 'filter' to 'none' */
				background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y0ZjRmNCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0iI2YzZjNmMyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmNGY0ZjQiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
				background: -moz-linear-gradient(top, #f3f3f3 0%, #f4f4f4 50%, #e1e1e1 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f4f4f4), color-stop(50%,#f3f3f3), color-stop(100%,#e1e1e1)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top, #f3f3f3 0%,#f4f4f4 50%,#e1e1e1 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top, #f3f3f3 0%,#f4f4f4 50%,#e1e1e1 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top, #f3f3f3 0%,#f4f4f4 50%,#e1e1e1 100%); /* IE10+ */
				background: linear-gradient(to bottom, #f3f3f3 0%,#f4f4f4 50%,#e1e1e1 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f3f3f3', endColorstr='#e1e1e1',GradientType=0 ); /* IE6-8 */
			}
			.tbra {
				/* IE9 SVG, needs conditional override of 'filter' to 'none' */
				background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2FmYjNiNyIgc3RvcC1vcGFjaXR5PSIwLjY1Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjQ0JSIgc3RvcC1jb2xvcj0iI2VkZWJmMSIgc3RvcC1vcGFjaXR5PSIwLjY1Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNlY2YyZjkiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
				background: -moz-linear-gradient(left, rgba(175,179,183,0.65) 0%, rgba(237,235,241,0.65) 44%, rgba(236,242,249,0) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(175,179,183,0.65)), color-stop(44%,rgba(237,235,241,0.65)), color-stop(100%,rgba(236,242,249,0))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(left, rgba(175,179,183,0.65) 0%,rgba(237,235,241,0.65) 44%,rgba(236,242,249,0) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(left, rgba(175,179,183,0.65) 0%,rgba(237,235,241,0.65) 44%,rgba(236,242,249,0) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(left, rgba(175,179,183,0.65) 0%,rgba(237,235,241,0.65) 44%,rgba(236,242,249,0) 100%); /* IE10+ */
				background: linear-gradient(to right, rgba(175,179,183,0.65) 0%,rgba(237,235,241,0.65) 44%,rgba(236,242,249,0) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6afb3b7', endColorstr='#00ecf2f9',GradientType=1 ); /* IE6-8 */
				float: right;
				width: 31px;
				height: 100%;
				border-left: 1px solid #9e9e9e;
				border-top-right-radius: 5px;
				border-bottom-right-radius: 5px;
				cursor: pointer;
			}
			.tbla {
				/* IE9 SVG, needs conditional override of 'filter' to 'none' */
				background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2VjZjJmOSIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjU2JSIgc3RvcC1jb2xvcj0iI2VkZWJmMSIgc3RvcC1vcGFjaXR5PSIwLjY1Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNhZmIzYjciIHN0b3Atb3BhY2l0eT0iMC42NSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
				background: -moz-linear-gradient(left, rgba(236,242,249,0) 0%, rgba(237,235,241,0.65) 56%, rgba(175,179,183,0.65) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(236,242,249,0)), color-stop(56%,rgba(237,235,241,0.65)), color-stop(100%,rgba(175,179,183,0.65))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(left, rgba(236,242,249,0) 0%,rgba(237,235,241,0.65) 56%,rgba(175,179,183,0.65) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(left, rgba(236,242,249,0) 0%,rgba(237,235,241,0.65) 56%,rgba(175,179,183,0.65) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(left, rgba(236,242,249,0) 0%,rgba(237,235,241,0.65) 56%,rgba(175,179,183,0.65) 100%); /* IE10+ */
				background: linear-gradient(to right, rgba(236,242,249,0) 0%,rgba(237,235,241,0.65) 56%,rgba(175,179,183,0.65) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ecf2f9', endColorstr='#a6afb3b7',GradientType=1 ); /* IE6-8 */
				float: left;
				width: 31px;
				height: 100%;
				border-right: 1px solid #9e9e9e;
				border-top-left-radius: 5px;
				border-bottom-left-radius: 5px;
				cursor: pointer;
			}
			.btbg {
				/* IE9 SVG, needs conditional override of 'filter' to 'none' */
				background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzFjNTU5NCIgc3RvcC1vcGFjaXR5PSIwLjY1Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMyYzc5YjMiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
				background: -moz-linear-gradient(top, rgba(28,85,148,0.65) 0%, rgba(44,121,179,1) 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(28,85,148,0.65)), color-stop(100%,rgba(44,121,179,1))); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(top, rgba(28,85,148,0.65) 0%,rgba(44,121,179,1) 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(top, rgba(28,85,148,0.65) 0%,rgba(44,121,179,1) 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(top, rgba(28,85,148,0.65) 0%,rgba(44,121,179,1) 100%); /* IE10+ */
				background: linear-gradient(to bottom, rgba(28,85,148,0.65) 0%,rgba(44,121,179,1) 100%); /* W3C */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a61c5594', endColorstr='#2c79b3',GradientType=0 ); /* IE6-8 */
				color: white;
			}
			.btt {
				-webkit-transform: rotate(-90deg);
				-moz-transform: rotate(-90deg);
				-ms-transform: rotate(-90deg);
				-o-transform: rotate(-90deg);
				transform: rotate(-90deg);
				-webkit-transform-origin: 50% 50%;
				-moz-transform-origin: 50% 50%;
				-ms-transform-origin: 50% 50%;
				-o-transform-origin: 50% 50%;
				transform-origin: 50% 50%;
				filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
			}
			/* Arrows */
			.ardnc {
				width: 0; 
				height: 0; 
				border-left: 5px solid transparent;
				border-right: 5px solid transparent;
				border-top: 5px solid #666;
				position: absolute;
				bottom: 8px;
				right: 5px;
			}
			.ardna {
				width: 0; 
				height: 0; 
				border-left: 5px solid transparent;
				border-right: 5px solid transparent;
				border-top: 5px solid #fff;
				position: absolute;
				bottom: 6px;
				right: 5px;
			}
			.ardnb {
				width: 0; 
				height: 0; 
				border-left: 5px solid transparent;
				border-right: 5px solid transparent;
				border-top: 5px solid #000;
				position: absolute;
				bottom: 5px;
				right: 5px;
			}
			.arrt {
				width: 0;
				height: 0;
				border-top: 9px solid transparent;
				border-bottom: 9px solid transparent;
				border-left: 9px solid #2a7bb4;
				margin: 40px 0 0 13px;
			}
			.arlt {
				width: 0;
				height: 0;
				border-top: 9px solid transparent;
				border-bottom: 9px solid transparent;
				border-right: 9px solid #2a7bb4;
				margin: 40px 0 0 10px;
			}
			.itm {
				margin: 2px 0 0 3px;
				border: 1px solid #eaf2f8;
				width: 127px;
				height: 91px;
				float: left;
				list-style: none;
				text-align: center;
				cursor: pointer;
			}
			.helperouter {
				height: 68px;
			}
			.helper {
				display: inline-block;
				height: 100%;
				vertical-align: middle;
			}
			.itm img {
				vertical-align: middle;
			}
			.txt {
				border-bottom: 1px solid #bbb;
				height: 22px;
				background-color: #fff;
				font-family: Arial;
				font-size: 10px;
				position: relative;
			}
			.txt.nobottom {
				border-bottom: none !important;
			}
			.txt .val {
				position: absolute;
				top: 6px;
				left: 5px;
			}
			.buttons {
				float: right;
				width: 92px;
			}
			.buttons .wallcol {
				margin: 2px 0 0 0;
				font-family: Arial;
				text-align: center;
				font-size: 10px;
				font-weight: bold;
				color: white;
				text-shadow: 1px -1px 0px rgba(0, 0, 0, 1);
			}
			.buttons .wallout {
				margin: 6px 0 11px 7px;
				border: 1px solid #949494;
				width: 75px;
				border-radius: 3px;
				height: 18px;
				background-color: #949494;
			}
			.buttons .itemcol {
				margin: 2px 0 0 0;
				font-family: Arial;
				text-align: center;
				font-size: 10px;
				font-weight: bold;
				color: white;
				text-shadow: 1px -1px 0px rgba(0, 0, 0, 1);
			}
			.buttons .itemout {
				margin: 6px 0 0 7px;
				border: 1px solid #949494;
				width: 75px;
				border-radius: 3px;
				height: 18px;
				background-color: #949494;
			}
			.buttons .inner {
				padding: 1px;
			}
			.wallout .pos {
				width: 100%;
				height: 16px;
				border-radius: 1px;
				position: relative;
			}
			.itemout .pos {
				width: 100%;
				height: 16px;
				border-radius: 1px;
				background-color: #603F3B;
				position: relative;
			}
			.grid {
				height: 483px;
			}
			.grid div {
				padding: 5px;
				position: relative;
			}
			.btnbar {
				background-color: #2a7bb4;
				height: 41px;
			}
			.btnbar .inner {
				padding: 3px 3px 3px 2px;
				position: relative;
			}
			.btnbar .inner .left {
				float: left;
			}
			.btnbar .inner .right {
				float: right;
			}
			.prev {
				font-family: Arial;
				font-size: 14px;
				padding: 5px 17px 8px;
				border: 1px solid #333;
				border-radius: 6px;
			}
			.next {
				font-family: Arial;
				font-size: 14px;
				padding: 5px 29px 8px;
				border: 1px solid #333;
				border-radius: 6px;
			}
			.mid {
				position: absolute;
				width: 100%;
				text-align: center;
			}
			.mid button {
				font-family: Arial;
				font-size: 14px;
				padding: 5px 5px 8px;
				border: 1px solid #333;
				border-radius: 6px;
			}
			dl {
				margin: 0;
			}
			dd {
				width: 126px;
				height: 100px;
				margin: 1px;
				padding: 0;
				text-align: center;
				border-top: 1px solid #eee;
				border-bottom: 1px solid #eee;
			}
			dl.wide {
				width: 390px;
			}
			dl.wide dd {
				float: left;
				display: inline-block;
				border: 1px solid #eee;
			}
			dd.selected {
				background: url(tick.png) no-repeat 104px 5px, #eff7f0;
			}
			dd:hover {
				background-color: #EAF2F8;
				border-top: 1px solid #7eafd4;
				border-bottom: 1px solid #7eafd4;
			}
			dl.wide dd:hover {
				border: 1px solid #7eafd4;
			}
			dd.selected:hover {
				background: url(tick.png) no-repeat 104px 5px, #eff7f0;
				border-top: 1px solid #eee;
				border-bottom: 1px solid #eee;
			}
			dl.wide dd.selected:hover {
				border: 1px solid #eee;
			}
			dd .helperouter {
				height: 87px !important;
			}
			dd img {
				display: inline-block;
				vertical-align: middle;
			}
			dd div {
				font-family: Arial;
				font-size: 12px;
				margin: -3px 0 3px 0;
			}
			dl.wide dd:last-child {
				width: 99.1%;
			}
			dd:last-child {
				height: 20px;
				background-color: #FFFFCC;
			}
			dd:last-child div {
				line-height: 28px;
			}
			.preview {
				position: relative;
				border: 1px dashed transparent;
			}
			.preview:hover {
				background-color: #d2d2d2;
			}
			.preview span {
				cursor: pointer;
				display: none;
				position: absolute;
				right: -10px;
				top: -10px;
			}
			.dim_left {
				position: absolute;
				top: 43%;
				left: -10px;
				font-family: Arial;
				font-size: 12px;
				background-color: #fff;
			}
			.dim_bottom {
				position: absolute;
				top: 98%;
				left: 48%;
				font-family: Arial;
				font-size: 12px;
				background-color: #fff;
			}
			body > dd.ui-draggable {
				display: none;
			}
			#dialog-modal {
				font-size: 12px;
			}
			.ui-dialog-title {
				font-size: 12px;
			}
			.ui-dialog-buttonset {
				font-size: 12px;
			}
		</style>
		<link rel="stylesheet" href="ui/jquery-ui.min.css" />
		<script src="jquery-1.8.3.min.js"></script>
		<script src="ui/jquery.ui.core.js"></script>
		<script src="ui/jquery.ui.widget.js"></script>
		<script src="ui/jquery.ui.mouse.js"></script>
		<script src="ui/jquery.ui.position.js"></script>
		<script src="ui/jquery.ui.dialog.js"></script>
		<script src="ui/jquery.ui.draggable.js"></script>
		<script src="ui/jquery.ui.droppable.js"></script>
		<script src="jquery-collision.min.js"></script>
		<!--
		<script src="jquery-ui-draggable-collision.min.js"></script>
		-->
		<script>
			function drawCanvas () {
				var canvas = document.getElementById ('plot');
				var context = canvas.getContext ('2d');
				context.fillStyle = '#fbfbfb';
				context.fillRect (40, 16, 860, 440);
				context.strokeStyle = '#ddd';
				context.strokeRect (39, 15, 862, 442);
				context.font = "12px Arial";
				context.strokeStyle = '#333';
				context.fillStyle = '#000';
				for (var i = 0; i <= 192; i += 12) {
					if (i) {
						context.fillText (i + ' "', 32 + (i / 12 * 53.5), 11);
						context.beginPath ();
						context.moveTo ((i > 99 ? 44 : 39) + (i / 12 * 53.5), 13);
						context.lineTo ((i > 99 ? 44 : 39) + (i / 12 * 53.5), 19);
						context.stroke ();
					}
				}
				context.save ();
				context.translate (-15, 460);
				context.rotate (-Math.PI/2);
				for (var i = 0; i <= 96; i += 12) {
					if (i) {
						context.fillText (i + ' "', -4 + (i / 12 * 55), 50);
						context.beginPath ();
						context.moveTo ((i > 99 ? 8 : 3) + (i / 12 * 55), 52);
						context.lineTo ((i > 99 ? 8 : 3) + (i / 12 * 55), 58);
						context.stroke ();
					}
				}
				context.restore ();
				context.strokeStyle = '#eee';
				context.lineWidth = 3;
				for (var i = 0; i < 420; i += 22.5) {
					context.beginPath ();
					context.moveTo (40, 35 + i);
					context.lineTo (900, 35 + i);
					context.stroke ();
				}
			}
			function clearClickedSelections () {
				$('body .preview.selected').each (function () {
					$(this).css ('border-color', 'transparent').css ('background-color', 'transparent');
					$(this).find ('div').css ('display', 'none');
					$(this).find ('span').css ('display', 'none');
					$(this).removeClass ('selected');
				});
			}
			$(document).ready(function () {
				drawCanvas ();
				$('.pics li').on ('mouseover', function () {
					if ((lastOver) && ($(this)[0] == lastOver[0])) {
						return; // ignore
					}
					if ($('#overlay').css ('display') != 'none') {
						$('#overlay').css ('display', 'none');
						$('#selections').css ('display', 'none');
						$('.items .txt').removeClass ('nobottom').find ('.ardnc').css ('display', '');
						lastOver = null;
					}
					$(this).css ('border', '1px solid #2a7bb4');
				}).on ('mouseout', function () {
					$(this).css ('border', '1px solid #eaf2f8');
				}).on ('click', function () {
					$('#overlay').css ('display', '').css ('left', $(this).offset ().left);
					if ($(this).find ('dl')[0].className == 'wide') {
						// TODO: Move offset by a further 128/130 pixels if the popup will flow off the edge of the canvas
						$('#selections').css ('display', '').css ('left', $(this).offset ().left - 131).html ('');
					} else {
						$('#selections').css ('display', '').css ('left', $(this).offset ().left).html ('');
					}
					$(this).find ('dl').clone ().appendTo ('#selections').css ('display', '');
					$('#selections dd').draggable ({
						helper: function () {
							var currWall = $('.mid .btbg')[0].value;
							return $('<div class="preview wall' + currWall + '" style="width: 231px; height: 270px; background: url(pic5-c-big.png) no-repeat 0 0, #e2e2e2;"><div class="dim_left">28"</div><div class="dim_bottom">14"</div><span><img src="red_x.gif" /></span></div>').appendTo ('body').draggable ({
								start: function (event, ui) {
									$(this).appendTo ('body');
								},
								drag: function (event, ui) {
									clearClickedSelections ();
									$(this).css ('border-color', 'black').css ('background-color', '#c8c8c8');
									$(this).find ('span').css ('display', 'inline');
									$(this).find ('div').css ('display', '');
									$(this).addClass ('selected');
									if ($(this).collision ('.preview:visible').length > 1) {
										$(this).css ('border-color', 'red').css ('background-color', 'rgba(243, 193, 193, 0.5)');
									} else {
										$(this).css ('border-color', 'black').css ('background-color', '#c8c8c8');
									}
								},
								containment: '#plotoverlay',
								revert: function () {
									if ($(this).collision ('.preview:visible').length > 1) {
										$('#dialog-modal p').html ('You are trying to overlap two items. The trim on the item will go red when you are infringing on another item.');
										$('#dialog-modal').dialog ({
											modal: true, 
											buttons: {
												Ok: function () {
													$(this).dialog ('close');
												}
											},
											position: 'center'
										});
										$(this).css ('border-color', 'black').css ('background-color', '#c8c8c8');
									}
									return ($(this).collision ('.preview:visible').length > 1);
								}
							}).on ('click', function () {
								clearClickedSelections ();
								$(this).css ('border-color', 'black').css ('background-color', '#c8c8c8');
								$(this).find ('div').css ('display', '');
								$(this).find ('span').css ('display', 'inline').off ('click').on ('click', function () {
									$(this).closest ('.preview').remove ();
								});
								$(this).addClass ('selected');
							}).on ('mouseover', function () {
								if ($(this).hasClass ('selected') == false) {
									$(this).css ('border-color', 'black').css ('background-color', '#e2e2e2');
									$(this).find ('div').css ('display', '');
								}
							}).on ('mouseout', function () {
								if ($(this).hasClass ('selected') == false) {
									$(this).css ('border-color', 'transparent').css ('background-color', 'transparent');
									$(this).find ('div').css ('display', 'none');
								}
							});
						},
						start: function (event, ui) {
							$('#overlay').css ('display', 'none');
							$('#selections').css ('display', 'none');
							$('.items .txt').removeClass ('nobottom').find ('.ardnc').css ('display', '');
							$(this).appendTo ('body');
						},
						drag: function (event, ui) {
							if ($(ui.helper).collision ('.preview:visible').length > 1) {
								$(ui.helper).css ('border-color', 'red').css ('background-color', 'rgba(243, 193, 193, 0.5)');
							} else {
								$(ui.helper).css ('border-color', 'black').css ('background-color', '#c8c8c8');
							}
						},
						stop: function (event, ui) {
							if ($(ui.helper).collision ('.preview:visible').length > 1) {
								$('#dialog-modal p').html ('When dragging you items into your grid, beware not to place the item on top of an existing item. Items placed on top of another one will disappear. Simply drag and drop again making sure not to infringe on existing items.');
								$('#dialog-modal').dialog ({
									modal: true, 
									buttons: {
										Ok: function () {
											$(this).dialog ('close');
										}
									},
									position: 'center'
								});
								$(ui.helper).remove ();
							}
						},
						containment: '#plotoverlay'
					});
					$('#plotoverlay').droppable ({
						drop: function (event, ui) {
							$.ui.ddmanager.current.cancelHelperRemoval = true;
						}
					}).on ('click', function () {
						clearClickedSelections ();
					});
					var img = $(this).find ('.itmpic');
					var imgoff = img.offset ();
					// make it absolute positioned
					img.css ('position', 'absolute').css ('z-index', 30).css ('left', imgoff.left).css ('top', imgoff.top);
					var txt = $(this).find ('.txt');
					var txtoff = txt.offset ();
					// make it absolute positioned
					txt.css ('position', 'absolute').css ('z-index', 30).css ('left', txtoff.left).css ('top', txtoff.top).css ('width', 127).addClass ('nobottom').find ('.ardnc').css ('display', 'none');
					lastOver = $(this);
				});
				$('.mid button').on ('click', function () {
					var currWall = $('.mid .btbg')[0].value;
					var nextWall = $(this)[0].value;
					$('.wall' + currWall).hide ();
					$('.wall' + nextWall).show ();
					$('.mid button').toggleClass ('btbg', false).toggleClass ('tbgb', true);
					$(this).toggleClass ('btbg', true);
				});
			});
			var lastOver = null;
		</script>
    </head>
    <body>

		<!--[if eq IE 9]>
		  <style type="text/css">
			.tbgb, .tbla, .tbra, .btbg {
			   filter: none;
			}
		  </style>
		<![endif]-->
		<!--[if gte IE 9]>
		  <style type="text/css">
			.btt {
			   filter: none;
			}
		  </style>
		<![endif]-->

		<div class="outer">
			<div class="tb">
				<div class="tbgb intro">
					You are ready to start designing; click and drag your accessories onto the grids of walls A,B,C.<!-- below.-->
				</div>
			</div>
			<div class="slider">
				<div class="inner">
					<div class="items">
						<div class="tbla"><div class="arlt"></div></div>
						<div class="pics">
							<ul>
								<li class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="pic1.png" /></div><div class="txt"><div class="val">Shelf Cabinet</div><div class="ardnc"></div></div>
									<dl style="display: none;">
										<dd class="selected"><div class="helperouter"><span class="helper"></span><img src="pic1-a.png" /></div><div>Mocha</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic1-b.png" /></div><div>Maple</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</li>
								<li class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="pic3.png" /></div><div class="txt"><div class="val">Shelf Cabinet w/Doors</div><div class="ardnc"></div></div>
									<dl style="display: none;">
										<dd class="selected"><div class="helperouter"><span class="helper"></span><img src="pic2-a.png" /></div><div>Mocha</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic2-b.png" /></div><div>Maple</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</li>
								<li class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="pic2.png" /></div><div class="txt"><div class="val">Cabinet 4 Drawer</div><div class="ardnc"></div></div>
									<dl style="display: none;">
										<dd class="selected"><div class="helperouter"><span class="helper"></span><img src="pic3-a.png" /></div><div>Mocha</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic3-b.png" /></div><div>Maple</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</li>
								<li class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="pic5.png" /></div><div class="txt"><div class="val">Shelf With Pole 24"</div><div class="ardnc"></div></div>
									<dl class="wide" style="display: none;">
										<dd><div class="helperouter"><span class="helper"></span><img src="pic4-a.png" /></div><div>Mocha/Shirts</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic4-b.png" /></div><div>Mocha/Pants</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic4-c.png" /></div><div>Mocha/Dress</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic4-a.png" /></div><div>Maple/Shirts</div></dd>
										<dd class="selected"><div class="helperouter"><span class="helper"></span><img src="pic4-b.png" /></div><div>Maple/Pants</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic4-c.png" /></div><div>Maple/Dress</div></dd>
										<dd><div>Drag and drop on your wall</div></dd>
									</dl>
								</li>
								<li class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="pic6.png" /></div><div class="txt"><div class="val">Shelf With Pole 48"</div><div class="ardnc"></div></div>
									<dl class="wide" style="display: none;">
										<dd><div class="helperouter"><span class="helper"></span><img src="pic5-a.png" /></div><div>Mocha/Shirts</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic5-b.png" /></div><div>Mocha/Pants</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic5-c.png" /></div><div>Mocha/Dress</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic5-a.png" /></div><div>Maple/Shirts</div></dd>
										<dd class="selected"><div class="helperouter"><span class="helper"></span><img src="pic5-b.png" /></div><div>Maple/Pants</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic5-c.png" /></div><div>Maple/Dress</div></dd>										
										<dd><div>Drag and drop on your wall</div></dd>
									</dl>
								</li>
								<li class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="pic4.png" /></div><div class="txt"><div class="val">Shelf 24"</div><div class="ardnc"></div></div>
									<dl style="display: none;">
										<dd class="selected"><div class="helperouter"><span class="helper"></span><img src="pic6-a.png" /></div><div>Mocha</div></dd>
										<dd><div class="helperouter"><span class="helper"></span><img src="pic6-b.png" /></div><div>Maple</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</li>
							</ul>
						</div>
						<div class="tbra"><div class="arrt"></div></div>
					</div>
					<div class="buttons">
						<div class="wallcol">Wall Color</div>
						<div class="wallout">
							<div class="inner">
								<div class="tbgb pos"><div class="ardnb"></div><div class="ardna"></div></div>
							</div>
						</div>
						<div class="itemcol">Item Color</div>
						<div class="itemout">
							<div class="inner">
								<div class="pos"><div class="ardnb"></div><div class="ardna"></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="grid">
				<div>
					<canvas id="plot" width="955" height="470">
					    HTML5 Canvas not supported
					</canvas>
					<div id="plotoverlay" style="position: absolute; top: 16px; left: 40px; width: 862px; height: 442px"></div>
				</div>
			</div>
			<div class="btnbar">
				<div class="inner">
					<div class="left">
						<button class="tbgb prev">Previous step</button>
					</div>
					<div class="right">
						<button class="tbgb next">Next Step</button>
					</div>
					<div class="mid">
						<button class="tbgb" value="A">Wall A (192"x96")</button>
						<button class="btbg" value="B">Wall B (192"x96")</button>
						<button class="tbgb" value="C">Wall C (192"x96")</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Popover objects -->
		<div id="overlay" style="display: none; position: absolute; z-index: 20; border: 1px solid #2a7bb4; border-bottom: none; top: 33px; left: 0px; width: 128px; height: 100px; background-color: #fff"></div>
		<div id="selections" style="display: none; position: absolute; z-index: 20; border: 1px solid #2a7bb4; border-top: none; top: 134px; left: 0px; background-color: #fff"></div>
		<div id="dialog-modal" title="Warning" style="display: none;"><p>Message</p></div>

    </body>
</html>
