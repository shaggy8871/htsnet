function getOptionByColor (sku, color) {
	for (var i = 0; i < shoppingLookup[sku]['options'].length; i++) {
		if (shoppingLookup[sku]['options'][i][1] == color) {
			return i;
		}
	}
	return 0;
}

function drawCanvas (wall, visible) {
	//--- Get dimensions
	if ($('#plot' + wall).length != 0) {
		$('#plot' + wall).remove ();
	}
	if ($('#plotoverlay' + wall).length != 0) {
		$('#plotoverlay' + wall).remove ();
	}
	wFeet = $('#metrics' + wall + ' .width')[0].value;
	hFeet = $('#metrics' + wall + ' .height')[0].value;
	if (hFeet > 72) {
		hFeet = 72; // forced max height?
	}
	inchInFeet = 12;
	feetInPixels = 54;
	dimW = parseInt (wFeet / inchInFeet * feetInPixels);
	dimH = parseInt (hFeet / inchInFeet * feetInPixels);
	scaleX = 1;
	scaleY = 1;
	if (((hFeet >= 80) && (hFeet < 120)) && ((wFeet >= 100) && (wFeet <= 200))) {
		scaleX = 0.9;
		scaleY = 0.9;
	} else
	if ((hFeet >= 120) || (wFeet > 200)) {
		scaleX = 0.8;
		scaleY = 0.8;
	}
	topX = parseInt (((958 / scaleX) - (dimW)) / 2);
	topY = (470 - (15 * 4.5) - dimH) / scaleY; //parseInt (((470 / scaleY) - (dimH)) / 2);
	if (topX < 20) {
		topX = 20;
	}
	if (topY < 20) {
		topY = 20;
	}
	var canvas = $('<canvas id="plot' + wall + '" width="958" height="470"' + (!visible ? ' style="display: none;"' : '') + '>HTML5 Canvas not supported</canvas>');
	var context = canvas[0].getContext ('2d');
	$('.grid > div').append (canvas);
	$('.grid > div').append ('<div id="plotoverlay' + wall + '" class="plotoverlay" style="' + (!visible ? 'display: none; ' : '') + 'position: absolute; top: ' + (topY * scaleY) + 'px; left: ' + (topX * scaleX) + 'px; width: ' + parseInt (dimW * scaleX) + 'px; height: ' + parseInt (dimH * scaleY) + 'px"></div>');
	$('.grid > div').append ('<div id="plotoverlaywide' + wall + '" style="z-index: -1; position: absolute; top: ' + (topY * scaleY) + 'px; left: 5px; width: 958px; height: ' + parseInt (470 - (topY * scaleY)) + 'px"></div>'); // dimH * scaleY
	//--- Scale down if it's too big
	context.scale (scaleX, scaleY);
	wallScale[wall] = [scaleX, scaleY];
	//--- Draw and fill rectangle
	switch (backgroundStyle) {
		case 'White':		context.fillStyle = '#fbfbfb'; break;
		case 'Charcoal':	context.fillStyle = '#444'; break;
		case 'Light gray':	context.fillStyle = '#ddd'; break;
	}
	context.fillRect (topX, topY, dimW, dimH);
	context.strokeStyle = '#ddd';
	context.strokeRect (topX - 1, topY - 1, dimW + 2, dimH + 2);
	//--- Set font
	context.font = "12px Arial";
	context.strokeStyle = '#333';
	context.fillStyle = '#000';
	context.save ();
	context.translate (topX, topY);
	//--- Horizontal markers
	for (var i = 0; i <= wFeet; i += inchInFeet) {
		if (i) {
			context.fillText (i + ' "', (i / inchInFeet * feetInPixels) - (i > 99 ? 12 : 8), (scaleX == 0.9 ? -12 : -8));
			context.beginPath ();
			context.moveTo ((i / inchInFeet * feetInPixels), -4);
			context.lineTo ((i / inchInFeet * feetInPixels), 2);
			context.stroke ();
		}
	}
	context.restore ();
	context.save ();
	context.translate (topX, topY + dimH);
	context.rotate (-Math.PI / 2); // Flip 90 degrees
	//--- Vertical markers
	for (var i = 0; i <= hFeet; i += inchInFeet) {
		if (i) {
			context.fillText (i + ' "', (i / inchInFeet * feetInPixels) - (i > 99 ? 12 : 8), (scaleY != 1 ? -8 : -8));
			context.beginPath ();
			context.moveTo ((i / inchInFeet * feetInPixels), -4);
			context.lineTo ((i / inchInFeet * feetInPixels), 2);
			context.stroke ();
		}
	}
	context.restore ();
	context.strokeStyle = '#eee';
	context.lineWidth = 3;
	//--- Panel lines
	for (var i = topY; i <= topY + dimH; i += 21.4) {
		if ((21.4 + i) <= (topY + dimH)) {
			context.beginPath ();
			context.moveTo (topX, 21.4 + i);
			context.lineTo (topX + dimW, 21.4 + i);
			context.stroke ();
		}
	}
}

function preloadProducts (wall, products) {
	wFeet = $('#metrics' + wall + ' .width')[0].value;
	hFeet = $('#metrics' + wall + ' .height')[0].value;
	if (hFeet > 72) {
		hFeet = 72; // forced max height?
	}
	inchInFeet = 12;
	feetInPixels = 54;
	dimW = parseInt (wFeet / inchInFeet * feetInPixels);
	dimH = parseInt (hFeet / inchInFeet * feetInPixels);
	scaleX = 1;
	scaleY = 1;
	if ((wFeet >= 150) && (wFeet < 200)) {
		scaleX = 0.8;
		scaleY = 0.8;
	} else
	if ((wFeet >= 200) && (wFeet < 230)) {
		scaleX = 0.7;
		scaleY = 0.7;
	} else
	if ((wFeet >= 230)) {
		scaleX = 0.65;
		scaleY = 0.65;
	}
	topX = parseInt (((770 / scaleX) - (dimW)) / 2);
	topY = 20;
	if (topX < 20) {
		topX = 20;
	}
	var currWall = (configSelected == 'reach-in' ? 'R' : $('#design .mid .btbg')[0].value);
	var overlayL = parseInt ($('#plotoverlay' + wall).css ('left')) + parseInt ($('.grid div').offset ().left);
	var overlayT = parseInt ($('#plotoverlay' + wall).css ('top')) + parseInt ($('.grid div').offset ().top);
	if ($('#design').css ('display') != 'none') {
		hiddenWall = (wall != currWall);
	} else {
		hiddenWall = false;
	}
	if (hiddenWall) {
		$('.preview.wall' + wall).show ();
	}
	for (var x = 0; x < products.length; x++) {
		var imgUrl = products[x].src;
		var imgL = (((products[x].left - topX) * wallScale[wall][0]) + overlayL);
		var imgT = (((products[x].top - topY) * wallScale[wall][1]) + overlayT);
		var sku = products[x].sku;
		var color = products[x].color;
		var type = products[x].type;
		var original = $('dd[data-helper$="' + imgUrl.split ('/').pop ().replace (/(black|green|orange|red|white)/gi, 'black') + '"]');
		var scaleW = ((original.attr ('data-helper-w') ? parseInt (original.attr ('data-helper-w') * 4.5) : 216) * wallScale[wall][0]);
		var scaleH = ((original.attr ('data-helper-h') ? parseInt (original.attr ('data-helper-h') * 4.5) : 235) * wallScale[wall][1]);
		$('<div class="preview wall' + wall + ' ui-draggable" data-sku="' + sku + '" data-type="' + type + '" data-color="' + color + '" style="' + (!hiddenWall ? '' : 'display: none; ') + 'position: absolute; left: ' + imgL + 'px; top: ' + imgT + 'px; width: ' + scaleW + 'px; height: ' + scaleH + 'px; background: url(' + imgUrl + ') no-repeat 0 0, transparent; background-size: ' + scaleW + 'px ' + scaleH + 'px;"><div class="dim_left" style="display: none;">' + (original.attr ('data-helper-h') ? original.attr ('data-helper-h') : 0) + '"</div><div class="dim_bottom" style="display: none;">' + (original.attr ('data-helper-w') ? original.attr ('data-helper-w') : 0) + '"</div><span><img src="red_x.gif" /></span></div>').appendTo ('body').loadHelperEvents (wall);
	}
	if (hiddenWall) {
		$('.preview.wall' + wall).hide ();
	}
}

function cloneWall (wall) {
	//--- Get dimensions
	if ($('#clone' + wall).length != 0) {
		$('#clone' + wall).remove ();
	}
	wFeet = $('#metrics' + wall + ' .width')[0].value;
	hFeet = $('#metrics' + wall + ' .height')[0].value;
	if (hFeet > 72) {
		hFeet = 72; // forced max height?
	}
	inchInFeet = 12;
	feetInPixels = 54;
	dimW = parseInt (wFeet / inchInFeet * feetInPixels);
	dimH = parseInt (hFeet / inchInFeet * feetInPixels);
	scaleX = 1;
	scaleY = 1;
	if ((wFeet >= 150) && (wFeet < 200)) {
		scaleX = 0.8;
		scaleY = 0.8;
	} else
	if ((wFeet >= 200) && (wFeet < 230)) {
		scaleX = 0.7;
		scaleY = 0.7;
	} else
	if ((wFeet >= 230)) {
		scaleX = 0.65;
		scaleY = 0.65;
	}
	topX = parseInt (((770 / scaleX) - (dimW)) / 2);
	topY = 20;
	if (topX < 20) {
		topX = 20;
	}
	var canvas = $('<canvas id="clone' + wall + '" width="770" height="' + ((dimH * scaleY) + 20) +'">HTML5 Canvas not supported</canvas>');
	var context = canvas[0].getContext ('2d');
	var shadow = $('#shopping_list .paint').append ('<div id="shadow' + wall + '" class="shadow"><div class="header"><img src="shoppinglist_header.png" /></div></div>');
	$('#shadow' + wall).append (canvas);
	//--- Scale down if it's too big
	context.scale (scaleX, scaleY);
	//--- Draw and fill rectangle
	switch (backgroundStyle) {
		case 'White':		context.fillStyle = '#fbfbfb'; break;
		case 'Charcoal':	context.fillStyle = '#444'; break;
		case 'Light gray':	context.fillStyle = '#ddd'; break;
	}
	context.fillRect (topX, topY, dimW, dimH);
	context.strokeStyle = '#ddd';
	context.strokeRect (topX - 1, topY - 1, dimW + 2, dimH + 2);
	//--- Set font
	context.font = "12px Arial";
	context.strokeStyle = '#333';
	context.fillStyle = '#000';
	context.save ();
	context.translate (topX, topY);
	//--- Horizontal markers
	for (var i = 0; i <= wFeet; i += inchInFeet) {
		if (i) {
			context.fillText (i + ' "', (i / inchInFeet * feetInPixels) - (i > 99 ? 12 : 8), (scaleX == 0.9 ? -12 : -8));
			context.beginPath ();
			context.moveTo ((i / inchInFeet * feetInPixels), -4);
			context.lineTo ((i / inchInFeet * feetInPixels), 2);
			context.stroke ();
		}
	}
	context.restore ();
	context.save ();
	context.translate (topX, topY + dimH);
	context.rotate (-Math.PI / 2); // Flip 90 degrees
	//--- Vertical markers
	for (var i = 0; i <= hFeet; i += inchInFeet) {
		if (i) {
			context.fillText (i + ' "', (i / inchInFeet * feetInPixels) - (i > 99 ? 12 : 8), -8);
			context.beginPath ();
			context.moveTo ((i / inchInFeet * feetInPixels), -4);
			context.lineTo ((i / inchInFeet * feetInPixels), 2);
			context.stroke ();
		}
	}
	context.restore ();
	context.strokeStyle = '#eee';
	context.lineWidth = 3;
	for (var i = topY; i <= topY + dimH; i += 21.4) {
		if ((21.4 + i) <= (topY + dimH)) {
			context.beginPath ();
			context.moveTo (topX, 21.4 + i);
			context.lineTo (topX + dimW, 21.4 + i);
			context.stroke ();
		}
	}
	//--- Add pictures
	var overlayL = parseInt ($('#plotoverlay' + wall).css ('left')) + parseInt ($('.grid div').offset ().left);
	var overlayT = parseInt ($('#plotoverlay' + wall).css ('top')) + parseInt ($('.grid div').offset ().top);
	var bgSKU = '';
	var bgUPC = '';
	switch (backgroundStyle) {
		case 'White':		bgSKU = '86102';
							bgUPC = '782088861024';
							break;
		case 'Charcoal':	bgSKU = '86105';
							bgUPC = '782088861055';
							break;
		case 'Light gray':	bgSKU = '86107';
							bgUPC = '782088861079';
							break;
	}
	var total = 0.00;
	var table = '';
	table += '<table border="0" cellpadding="5" cellspacing="1">'
	table += '<tr><th>Description</th><th>SKU</th><th>Color</th><th>UPC</th><!--<th>Cost</th>--><th>QTY</th><!--<th>TOTAL</th>--></tr>';
	var boxCount = (wFeet <= 96 ? 1 : (wFeet <= 192 ? 2 : 3));
	table += '<tr><td>8"x6" Wall Panels + trims</td><td>' + bgSKU + '</td><td>' + backgroundStyle + '</td><td>' + bgUPC + '</td><!--<td>$ 219.99*</td>--><td>' + boxCount + '</td><!--<td>$ ' + parseFloat (219.99 * boxCount) + '*</td>--></tr>'; total += parseFloat (219.99 * boxCount);
	$('.preview.wall' + wall).each (function () {
		$(this).show ();
		var tmpImg = $('<img src="' + $(this).css ('background-image').slice (4, $(this).css ('background-image').indexOf (')')).replace (/"/g, '') +'" />');
		context.drawImage (tmpImg[0], parseInt ((parseInt ($(this).css ('left')) - parseInt (overlayL)) / wallScale[wall][0]) + topX - 5, parseInt ((parseInt ($(this).css ('top')) - parseInt (overlayT)) / wallScale[wall][1]) + topY - 5);
		$(this).hide ();
		var sku = $(this).attr ('data-sku');
		if (shoppingLookup[sku]) {
			var color = $(this).attr ('data-color');
			if (color) {
				color = getOptionByColor (sku, color);
			} else {
				color = 0;
			}
			table += '<tr><td>' + shoppingLookup[sku].desc + '</td><td>' + shoppingLookup[sku].options[color][0] + '</td><td>' + shoppingLookup[sku].options[color][1] + '</td><td>' + shoppingLookup[sku].options[color][2] + '</td><!--<td>$ ' + shoppingLookup[sku].options[color][3] + '*</td>--><td>1</td><!--<td>$ ' + parseFloat (shoppingLookup[sku].options[color][3]) + '*</td>--></tr>'; total += parseFloat (shoppingLookup[sku].options[color][3]);
		}
	});
	// Removal of Price column
	// table += '<tr class="totals"><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>$ ' + parseFloat (total).toFixed (2) + '*</td></tr>';
	table += '</table>';
	// table += '<span>*Suggested retail only - prices may vary.</span>';
	$(table).appendTo ('#shadow' + wall);
}

function totalWall () {
	var shadow = $('#shopping_list .paint').append ('<div id="shadowtotal" class="shadow"><div class="header"><img src="shoppinglist_header.png" /></div></div>');
	var bgSKU = '';
	var bgUPC = '';
	switch (backgroundStyle) {
		case 'White':		bgSKU = '86102';
							bgUPC = '782088861024';
							break;
		case 'Charcoal':	bgSKU = '86105';
							bgUPC = '782088861055';
							break;
		case 'Light gray':	bgSKU = '86107';
							bgUPC = '782088861079';
							break;
	}
	var total = 0.00;
	var table = '';
	table += '<table border="0" cellpadding="5" cellspacing="1">'
	table += '<tr><th>Description</th><th>SKU</th><th>Color</th><th>UPC</th><!--<th>Cost</th>--><th>QTY</th><!--<th>TOTAL</th>--></tr>';
	var boxCount = (configSelected == 'walk-in' ? 
					($('#metricsA .width')[0].value <= 96 ? 1 : ($('#metricsA .width')[0].value <= 192 ? 2 : 3)) + 
					($('#metricsB .width')[0].value <= 96 ? 1 : ($('#metricsB .width')[0].value <= 192 ? 2 : 3)) + 
					($('#metricsC .width')[0].value <= 96 ? 1 : ($('#metricsC .width')[0].value <= 192 ? 2 : 3)) : 
					($('#metricsR .width')[0].value <= 96 ? 1 : ($('#metricsR .width')[0].value <= 192 ? 2 : 3)));
	table += '<tr><td>8"x6" Wall Panels + trims</td><td>' + bgSKU + '</td><td>' + backgroundStyle + '</td><td>' + bgUPC + '</td><!--<td>$ 219.99*</td>--><td>' + boxCount + '</td><!--<td>$ ' + parseFloat (219.99 * boxCount) + '*</td>--></tr>'; total += parseFloat (219.99 * boxCount);
	$('.preview').each (function () {
		var sku = $(this).attr ('data-sku');
		if (shoppingLookup[sku]) {
			var color = $(this).attr ('data-color');
			if (color) {
				color = getOptionByColor (sku, color);
			} else {
				color = 0;
			}
			table += '<tr><td>' + shoppingLookup[sku].desc + '</td><td>' + shoppingLookup[sku].options[color][0] + '</td><td>' + shoppingLookup[sku].options[color][1] + '</td><td>' + shoppingLookup[sku].options[color][2] + '</td><!--<td>$ ' + shoppingLookup[sku].options[color][3] + '*</td>--><td>1</td><!--<td>$ ' + parseFloat (shoppingLookup[sku].options[color][3]) + '*</td>--></tr>'; total += parseFloat (shoppingLookup[sku].options[color][3]);
		}
	});
	// Removal of Price column
	// table += '<tr class="totals"><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>$ ' + parseFloat (total).toFixed (2) + '*</td></tr>';
	table += '</table>';
	// table += '<span>*Suggested retail only - prices may vary.</span>';
	$(table).appendTo ('#shadowtotal');
}

//--- Saving functions:

function saveWall (wall) {
	wFeet = $('#metrics' + wall + ' .width')[0].value;
	hFeet = $('#metrics' + wall + ' .height')[0].value;
	if (hFeet > 72) {
		hFeet = 72; // forced max height?
	}
	inchInFeet = 12;
	feetInPixels = 54;
	dimW = parseInt (wFeet / inchInFeet * feetInPixels);
	dimH = parseInt (hFeet / inchInFeet * feetInPixels);
	scaleX = 1;
	scaleY = 1;
	if ((wFeet >= 150) && (wFeet < 200)) {
		scaleX = 0.8;
		scaleY = 0.8;
	} else
	if ((wFeet >= 200) && (wFeet < 230)) {
		scaleX = 0.7;
		scaleY = 0.7;
	} else
	if ((wFeet >= 230)) {
		scaleX = 0.65;
		scaleY = 0.65;
	}
	topX = parseInt (((770 / scaleX) - (dimW)) / 2);
	topY = 20;
	if (topX < 20) {
		topX = 20;
	}
	var wallObj = {
		label: wall,
		backgroundStyle: backgroundStyle, 
		wFeet: $('#metrics' + wall + ' .width')[0].value, 
		hFeet: $('#metrics' + wall + ' .height')[0].value,
		products: []
	}
	var currWall = (configSelected == 'reach-in' ? 'R' : $('#design .mid .btbg')[0].value);
	var overlayL = parseInt ($('#plotoverlay' + wall).css ('left')) + parseInt ($('.grid div').offset ().left);
	var overlayT = parseInt ($('#plotoverlay' + wall).css ('top')) + parseInt ($('.grid div').offset ().top);
	$('.preview.wall' + wall).each (function () {
		if (wall != currWall) {
			$(this).show ();
		}
		wallObj.products.push ({
			src: $(this).css ('background-image').slice (4, $(this).css ('background-image').indexOf (')')).replace (/"/g, ''),
			left: parseInt ((parseInt ($(this).css ('left')) - parseInt (overlayL)) / wallScale[wall][0]) + topX,
			top: parseInt ((parseInt ($(this).css ('top')) - parseInt (overlayT)) / wallScale[wall][1]) + topY,
			sku: $(this).attr ('data-sku'),
			color: ($(this).attr ('data-color') ? $(this).attr ('data-color') : 'White')
		});
		if (wall != currWall) {
			$(this).hide ();
		}
	});
	return wallObj;
}

function saveWalls (email) {
	savedWalls = []; // save globally
	if (configSelected == 'walk-in') {
		savedWalls.push (saveWall ('A'));
		savedWalls.push (saveWall ('B'));
		savedWalls.push (saveWall ('C'));
	} else {
		savedWalls.push (saveWall ('R'));
	}
	if (email) {
		savedWalls.forEach (function (e) {
			e.email = email;
		});
	}
}

//--- Printing functions:

function printWall (wall, wFeet, hFeet, backgroundStyle, products) {
	//--- Get dimensions
	if (hFeet > 72) {
		hFeet = 72; // forced max height?
	}
	inchInFeet = 12;
	feetInPixels = 54;
	dimW = parseInt (wFeet / inchInFeet * feetInPixels);
	dimH = parseInt (hFeet / inchInFeet * feetInPixels);
	scaleX = 1;
	scaleY = 1;
	if ((wFeet >= 150) && (wFeet < 200)) {
		scaleX = 0.8;
		scaleY = 0.8;
	} else
	if ((wFeet >= 200) && (wFeet < 230)) {
		scaleX = 0.7;
		scaleY = 0.7;
	} else
	if ((wFeet >= 230)) {
		scaleX = 0.65;
		scaleY = 0.65;
	}
	topX = parseInt (((770 / scaleX) - (dimW)) / 2);
	topY = 20;
	if (topX < 20) {
		topX = 20;
	}
	var canvas = $('<canvas id="wall' + wall + '" width="770" height="' + ((dimH * scaleY) + 20) +'">HTML5 Canvas not supported</canvas>');
	var context = canvas[0].getContext ('2d');
	var shadow = $('#shopping_list').append ('<div id="page' + wall + '" class="page"><div class="header"><img src="shoppinglist_header.png" /></div></div>');
	$('#page' + wall).append (canvas);
	//--- Scale down if it's too big
	context.scale (scaleX, scaleY);
	//--- Draw and fill rectangle
	switch (backgroundStyle) {
		case 'White':		context.fillStyle = '#fbfbfb'; break;
		case 'Charcoal':	context.fillStyle = '#444'; break;
		case 'Light gray':	context.fillStyle = '#ddd'; break;
	}
	context.fillRect (topX, topY, dimW, dimH);
	context.strokeStyle = '#ddd';
	context.strokeRect (topX - 1, topY - 1, dimW + 2, dimH + 2);
	//--- Set font
	context.font = "12px Arial";
	context.strokeStyle = '#333';
	context.fillStyle = '#000';
	context.save ();
	context.translate (topX, topY);
	//--- Horizontal markers
	for (var i = 0; i <= wFeet; i += inchInFeet) {
		if (i) {
			context.fillText (i + ' "', (i / inchInFeet * feetInPixels) - (i > 99 ? 12 : 8), (scaleX == 0.9 ? -12 : -8));
			context.beginPath ();
			context.moveTo ((i / inchInFeet * feetInPixels), -4);
			context.lineTo ((i / inchInFeet * feetInPixels), 2);
			context.stroke ();
		}
	}
	context.restore ();
	context.save ();
	context.translate (topX, topY + dimH);
	context.rotate (-Math.PI / 2); // Flip 90 degrees
	//--- Vertical markers
	for (var i = 0; i <= hFeet; i += inchInFeet) {
		if (i) {
			context.fillText (i + ' "', (i / inchInFeet * feetInPixels) - (i > 99 ? 12 : 8), -8);
			context.beginPath ();
			context.moveTo ((i / inchInFeet * feetInPixels), -4);
			context.lineTo ((i / inchInFeet * feetInPixels), 2);
			context.stroke ();
		}
	}
	context.restore ();
	context.strokeStyle = '#eee';
	context.lineWidth = 3;
	for (var i = topY; i <= topY + dimH; i += 21.4) {
		if ((21.4 + i) <= (topY + dimH)) {
			context.beginPath ();
			context.moveTo (topX, 21.4 + i);
			context.lineTo (topX + dimW, 21.4 + i);
			context.stroke ();
		}
	}
	//--- Add pictures
	var overlayL = (topX * scaleX); // parseInt ($('#plotoverlay' + wall).css ('left')) + parseInt ($('.grid div').offset ().left);
	var overlayT = (topY * scaleY); // parseInt ($('#plotoverlay' + wall).css ('top')) + parseInt ($('.grid div').offset ().top);
	var bgSKU = '';
	var bgUPC = '';
	switch (backgroundStyle) {
		case 'White':		bgSKU = '86102';
							bgUPC = '782088861024';
							break;
		case 'Charcoal':	bgSKU = '86105';
							bgUPC = '782088861055';
							break;
		case 'Light gray':	bgSKU = '86107';
							bgUPC = '782088861079';
							break;
	}
	var total = 0.00;
	var table = '';
	var boxCount = (wFeet <= 96 ? 1 : (wFeet <= 192 ? 2 : 3));
	table += '<table border="0" cellpadding="5" cellspacing="1">'
	table += '<tr><th>Description</th><th>SKU</th><th>Color</th><th>UPC</th><!--<th>Cost</th>--><th>QTY</th><!--<th>TOTAL</th>--></tr>';
	table += '<tr><td>8"x6" Wall Panels + trims</td><td>' + bgSKU + '</td><td>' + backgroundStyle + '</td><td>' + bgUPC + '</td><!--<td>$ 219.99*</td>--><td>' + boxCount + '</td><!--<td>$ ' + parseFloat (219.99 * boxCount) + '*</td>--></tr>'; total += parseFloat (219.99 * boxCount);
	for (var x = 0; x < products.length; x++) {
		var imgUrl = products[x].src;
		var imgL = products[x].left - 5;
		var imgT = products[x].top - 5;
		var sku = products[x].sku;
		var color = products[x].color;
		var tmpImg = $('<img id="test' + x + '" src="' + imgUrl +'" />').on ('load', { ctx: context, x: imgL, y: imgT }, function (e) {
			e.data.ctx.drawImage (this, e.data.x, e.data.y);
		});
		if (shoppingLookup[sku]) {
			if (color) {
				color = getOptionByColor (sku, color);
			} else {
				color = 0;
			}
			table += '<tr><td>' + shoppingLookup[sku].desc + '</td><td>' + shoppingLookup[sku].options[color][0] + '</td><td>' + shoppingLookup[sku].options[color][1] + '</td><td>' + shoppingLookup[sku].options[color][2] + '</td><!--<td>$ ' + shoppingLookup[sku].options[color][3] + '*</td>--><td>1</td><!--<td>$ ' + parseFloat (shoppingLookup[sku].options[color][3]) + '*</td>--></tr>'; total += parseFloat (shoppingLookup[sku].options[color][3]);
		}
	}
	// Removal of Price column
	// table += '<tr class="totals"><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>$ ' + parseFloat (total).toFixed (2) + '*</td></tr>';
	table += '</table>';
	// table += '<span>*Suggested retail only - prices may vary.</span>';
	$(table).appendTo ('#page' + wall);
}

function printTotalWall (backgroundStyle, boxCount, products) {
	var shadow = $('#shopping_list').append ('<div id="pagetotal" class="page"><div class="header"><img src="shoppinglist_header.png" /></div></div>');
	var bgSKU = '';
	var bgUPC = '';
	switch (backgroundStyle) {
		case 'White':		bgSKU = '86102';
							bgUPC = '782088861024';
							break;
		case 'Charcoal':	bgSKU = '86105';
							bgUPC = '782088861055';
							break;
		case 'Light gray':	bgSKU = '86107';
							bgUPC = '782088861079';
							break;
	}
	var total = 0.00;
	var table = '';
	table += '<table border="0" cellpadding="5" cellspacing="1">'
	table += '<tr><th>Description</th><th>SKU</th><th>Color</th><th>UPC</th><!--<th>Cost</th>--><th>QTY</th><!--<th>TOTAL</th>--></tr>';
	table += '<tr><td>8"x6" Wall Panels + trims</td><td>' + bgSKU + '</td><td>' + backgroundStyle + '</td><td>' + bgUPC + '</td><!--<td>$ 219.99*</td>--><td>' + boxCount + '</td><!--<td>$ ' + parseFloat (219.99 * boxCount) + '*</td>--></tr>'; total += parseFloat (219.99 * boxCount);
	for (var x = 0; x < products.length; x++) {
		var sku = products[x].sku;
		var color = products[x].color;
		if (shoppingLookup[sku]) {
			if (color) {
				color = getOptionByColor (sku, color);
			} else {
				color = 0;
			}
			table += '<tr><td>' + shoppingLookup[sku].desc + '</td><td>' + shoppingLookup[sku].options[color][0] + '</td><td>' + shoppingLookup[sku].options[color][1] + '</td><td>' + shoppingLookup[sku].options[color][2] + '</td><!--<td>$ ' + shoppingLookup[sku].options[color][3] + '*</td>--><td>1</td><!--<td>$ ' + parseFloat (shoppingLookup[sku].options[color][3]) + '*</td>--></tr>'; total += parseFloat (shoppingLookup[sku].options[color][3]);
		}
	}
	// Removal of Price column
	// table += '<tr class="totals"><td>TOTAL</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>$ ' + parseFloat (total).toFixed (2) + '*</td></tr>';
	table += '</table>';
	// table += '<span>*Suggested retail only - prices may vary.</span>';
	$(table).appendTo ('#pagetotal');
}

function checkBoundaryHeight (boundaries, top, bottom) {
	if (!$.isArray (boundaries)) {
		return false;
	}
	for (var i = 0; i < boundaries.length; i++) {
		if (((top >= boundaries[i][0]) && (top <= boundaries[i][1])) || ((bottom >= boundaries[i][0]) && (bottom <= boundaries[i][1]))) {
			return true;
		}
	}
	return false;
}

function checkOutOfBounds (which, currWall) {
	var helperLeft = $(which).offset ().left + 2; // 2 = border
	var helperWidth = $(which).width ();
	var helperTop = $(which).offset ().top + 2;
	var helperHeight = $(which).height ();
	var wallLeft = $('#plotoverlay' + currWall).offset ().left + 5; // 5 = padding
	var wallWidth = $('#plotoverlay' + currWall).width ();
	var outOfBounds = false;
	switch (currWall) {
		case 'A':	if (($.isArray (wallBoundaryTests['B'][0])) && (helperLeft + helperWidth > wallLeft + wallWidth - (16 * 4.5))) {
						outOfBounds = checkBoundaryHeight (wallBoundaryTests['B'][0], helperTop, helperTop + helperHeight);
					}
					break;
		case 'B':	if (($.isArray (wallBoundaryTests['A'][1])) && (helperLeft < wallLeft + (16 * 4.5))) {
						outOfBounds = checkBoundaryHeight (wallBoundaryTests['A'][1], helperTop, helperTop + helperHeight);
					} else
					if (($.isArray (wallBoundaryTests['C'][0])) && (helperLeft + helperWidth > wallLeft + wallWidth - (16 * 4.5))) {
						outOfBounds = checkBoundaryHeight (wallBoundaryTests['C'][0], helperTop, helperTop + helperHeight);
					}
					break;
		case 'C':	if (($.isArray (wallBoundaryTests['B'][1])) && (helperLeft < wallLeft + (16 * 4.5))) {
						outOfBounds = checkBoundaryHeight (wallBoundaryTests['B'][1], helperTop, helperTop + helperHeight);
					}
					break;
	}
	return outOfBounds;
}

function checkOutOfBoundary (which, currWall) {
	var helperLeft = $(which).offset ().left + 2; // 2 = border
	var helperWidth = $(which).width ();
	var helperTop = $(which).offset ().top + 2;
	var helperHeight = $(which).height ();
	var helperType = $(which).attr ('data-type');
	var wallLeft = $('#plotoverlay' + currWall).offset ().left + 5; // 5 = padding
	var wallWidth = $('#plotoverlay' + currWall).width ();
	var wallTop = $('#plotoverlay' + currWall).offset ().top + 5; // 5 = padding
	var wallHeight = $('#plotoverlay' + currWall).height ();
	return ((helperType == 'shelf' ? false : (helperLeft < wallLeft) || (helperLeft + helperWidth > wallLeft + wallWidth))) || (helperLeft + helperWidth < wallLeft) || (helperLeft > wallLeft + wallWidth) || (helperTop > wallTop + wallHeight);
}

function saveWallBoundaries (currWall) {
	//--- Save boundary tests so we don't need to look it up later
	switch (currWall) {
		case 'A':	//--- Save right side only
					wallBoundaryTests[currWall] = [false, false];
					$('.preview.wall' + currWall).each (function () {
						if ($(this).offset ().left + $(this).width () > $('#plotoverlay' + currWall).offset ().left + $('#plotoverlay' + currWall).width () + 5 - (16 * 4.5)) {
							if ($.isArray (wallBoundaryTests[currWall][1])) {
								wallBoundaryTests[currWall][1].push ([$(this).offset ().top, $(this).offset ().top + $(this).height ()]);
							} else {
								wallBoundaryTests[currWall][1] = [[$(this).offset ().top, $(this).offset ().top + $(this).height ()]];
							}
						}
					});
					break;
		case 'B':	//--- Save both left and right side
					wallBoundaryTests[currWall] = [false, false];
					$('.preview.wall' + currWall).each (function () {
						if ($(this).offset ().left < $('#plotoverlay' + currWall).offset ().left + 5 + (16 * 4.5)) {
							if ($.isArray (wallBoundaryTests[currWall][0])) {
								wallBoundaryTests[currWall][0].push ([$(this).offset ().top, $(this).offset ().top + $(this).height ()]);
							} else {
								wallBoundaryTests[currWall][0] = [[$(this).offset ().top, $(this).offset ().top + $(this).height ()]];
							}								
						}
						if ($(this).offset ().left + $(this).width () > $('#plotoverlay' + currWall).offset ().left + $('#plotoverlay' + currWall).width () + 5 - (16 * 4.5)) {
							if ($.isArray (wallBoundaryTests[currWall][1])) {
								wallBoundaryTests[currWall][1].push ([$(this).offset ().top, $(this).offset ().top + $(this).height ()]);
							} else {
								wallBoundaryTests[currWall][1] =  [[$(this).offset ().top, $(this).offset ().top + $(this).height ()]];
							}
						}
					});
					break;
		case 'C':	//--- Save left of C
					wallBoundaryTests[currWall] = [false, false];
					$('.preview.wall' + currWall).each (function () {
						if ($(this).offset ().left < $('#plotoverlay' + currWall).offset ().left + 5 + (16 * 4.5)) {
							if ($.isArray (wallBoundaryTests[currWall][0])) {
								wallBoundaryTests[currWall][0].push ([$(this).offset ().top, $(this).offset ().top + $(this).height ()]);
							} else {
								wallBoundaryTests[currWall][0] = [[$(this).offset ().top, $(this).offset ().top + $(this).height ()]];
							}
						}
					});
					break;
	}
}

/*
 * Note: this is a jQuery extension function, not a standard one
 */
jQuery.fn.loadHelperEvents = function (currWall) {
	return $(this).draggable ({
		start: function (event, ui) {
			clearClickedSelections ();
			$(this).appendTo ('body');
		},
		drag: function (event, ui) {
			ui.position.top = Math.floor (ui.position.top / 3) * 3;
			$(this).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
			$(this).find ('span').css ('display', 'inline');
			$(this).find ('div').css ('display', '');
			$(this).addClass ('selected');
			if ((checkOutOfBounds (this, currWall)) || (checkOutOfBoundary (this, currWall)) || ($(this).collision ('.preview:visible').length > 1)) {
				$(this).css ('border-color', 'red').css ('background-color', 'rgba(243, 193, 193, 0.5)');
			} else {
				$(this).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
			}
		},
		stop: function (event, ui) {
			var collider = $(ui.helper).collision ('.plotoverlay:visible', { mode: 'protrusion', directionData: 'direction', as: '<div/>' });
			var collisionDetected = false;
			if (collider.length >= 1) {
				$(collider).each (function () {
					if (($(this).data ('direction').indexOf ('E') != -1) || ($(this).data ('direction').indexOf ('W') != -1)) {
						collisionDetected = true;
					}
				});
			}
			if (collisionDetected) {
				$('#dialog-modal p').html ('Your item will fit but you will need to cut it. Cutting instructions available on our website.');
				$('#dialog-modal').dialog ({
					modal: true, 
					buttons: {
						Ok: function () {
							$(this).dialog ('close');
						}
					},
					position: 'center'
				});
			}
		}, 
		containment: '#plotoverlaywide' + currWall,
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
				$(this).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
				return true;
			}
			if (checkOutOfBounds (this, currWall)) {
				$('#dialog-modal p').html ('You must leave a space of at least 16" from the edge in order to clear the item you placed on a another wall.');
				$('#dialog-modal').dialog ({
					modal: true, 
					buttons: {
						Ok: function () {
							$(this).dialog ('close');
						}
					},
					position: 'center'
				});
				$(this).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
				return true;
			}
			if (checkOutOfBoundary (this, currWall)) {
				$('#dialog-modal p').html ('Your item must be placed somewhere within the wall boundaries.');
				$('#dialog-modal').dialog ({
					modal: true, 
					buttons: {
						Ok: function () {
							$(this).dialog ('close');
						}
					},
					position: 'center'
				});
				$(this).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
				return true;
			}
			return false;
		}
	}).on ('click', function () {
		clearClickedSelections ();
		$(this).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
		$(this).find ('div').css ('display', '');
		$(this).find ('span').css ('display', 'inline').off ('click').on ('click', function () {
			$(this).closest ('.preview').remove ();
		});
		$(this).addClass ('selected');
	}).on ('mouseover', function () {
		if ($(this).hasClass ('selected') == false) {
			$(this).css ('border-color', 'black').css ('background-color', 'rgba(226, 226, 226, 0.5)');
			$(this).find ('div').css ('display', '');
		}
	}).on ('mouseout', function () {
		if ($(this).hasClass ('selected') == false) {
			$(this).css ('border-color', 'transparent').css ('background-color', 'transparent');
			$(this).find ('div').css ('display', 'none');
		}
	});
}

function loadCanvasEvents () {
	$('.pics .itm').off ('mouseover').on ('mouseover', function () {
		if ((lastOver) && ($(this)[0] == lastOver[0])) {
			return; // ignore
		}
		if ($('#overlay').css ('display') != 'none') {
			var img = lastOver.find ('.itmpic');
			// make it relatively positioned
			img.css ({'position': 'relative', 'left': '', 'top': ''});
			var txt = lastOver.find ('.txt');
			// make it relatively positioned
			txt.css ({'position': 'relative', 'left': '', 'top': ''});
			$('#overlay').css ('display', 'none');
			$('#selections').css ('display', 'none');
			$('.items .txt').removeClass ('nobottom').find ('.ardnc').css ('display', '');
			lastOver = null;
		}
		$(this).css ('border', '1px solid #2a7bb4');
	}).off ('mouseout').on ('mouseout', function () {
		$(this).css ('border', '1px solid #eaf2f8');
	}).off ('click').on ('click', function () {
		$('#overlay').css ('display', '').css ('left', $(this).offset ().left);
		if ($(this).find ('dl')[0].className == 'wide') {
			$('#selections').css ('display', '').css ('left', $(this).offset ().left - 131 + (($(this).offset ().left - 131) < 0 ? 131 : 0)).html ('');
		} else {
			$('#selections').css ('display', '').css ('left', $(this).offset ().left).html ('');
		}
		$(this).find ('dl').clone ().appendTo ('#selections').css ('display', 'block');
		var currWall = (configSelected == 'reach-in' ? 'R' : $('.mid .btbg')[0].value);
		$('#selections dd:not(:last-child)').draggable ({
			helper: function () {
				var currWall = (configSelected == 'reach-in' ? 'R' : $('.mid .btbg')[0].value);
				var scaleX = wallScale[currWall][0];
				var scaleY = wallScale[currWall][1];
				var scaleW = (($(this).attr ('data-helper-w') ? parseInt ($(this).attr ('data-helper-w') * 4.5) : 216) * scaleX);
				var scaleH = (($(this).attr ('data-helper-h') ? parseInt ($(this).attr ('data-helper-h') * 4.5) : 235) * scaleY);
				return $('<div class="preview wall' + currWall + '" data-sku="' + ($(this).attr ('data-sku') ? $(this).attr ('data-sku') : '') + '" data-type="' + ($(this).attr ('data-type') ? $(this).attr ('data-type') : '') + '" data-color="" style="width: ' + scaleW + 'px; height: ' + scaleH + 'px; background: url(' + ($(this).attr ('data-helper') ? (itemStyle ? $(this).attr ('data-helper').replace (/(black|green|orange|red|white)/gi, itemStyle.toLowerCase ()) : $(this).attr ('data-helper')) : '') + ') no-repeat 0 0, rgba(226, 226, 226, 0.5); background-size: ' + scaleW + 'px ' + scaleH + 'px;"><div class="dim_left">' + ($(this).attr ('data-helper-h') ? $(this).attr ('data-helper-h') : 0) + '"</div><div class="dim_bottom">' + ($(this).attr ('data-helper-w') ? $(this).attr ('data-helper-w') : 0) + '"</div><span><img src="red_x.gif" /></span></div>').appendTo ('body').loadHelperEvents (currWall);
			},
			start: function (event, ui) {
				clearClickedSelections ();
				var img = lastOver.find ('.itmpic');
				// make it relatively positioned
				img.css ({'position': 'relative', 'left': '', 'top': ''});
				var txt = lastOver.find ('.txt');
				// make it relatively positioned
				txt.css ({'position': 'relative', 'left': '', 'top': ''});
				$('#overlay').css ('display', 'none');
				$('#selections').css ('display', 'none');
				$('.items .txt').removeClass ('nobottom').find ('.ardnc').css ('display', '');
				$(this).appendTo ('body'); // Push to top of display (so it doesn't drag under another item)
			},
			drag: function (event, ui) {
				ui.position.top = Math.floor (ui.position.top / 3) * 3;
				if ((checkOutOfBounds (ui.helper, currWall)) || (checkOutOfBoundary (ui.helper, currWall)) || ($(ui.helper).collision ('.preview:visible').length > 1)) {
					$(ui.helper).css ('border-color', 'red').css ('background-color', 'rgba(243, 193, 193, 0.5)');
				} else {
					$(ui.helper).css ('border-color', 'black').css ('background-color', 'rgba(200, 200, 200, 0.5)');
				}
			},
			stop: function (event, ui) {
				if ($(ui.helper).collision ('.preview:visible').length > 1) {
					$('#dialog-modal p').html ('When dragging your items into your grid, beware not to place the item on top of an existing item. Items placed on top of another one will disappear. Simply drag and drop again making sure not to infringe on existing items.');
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
				var collider = $(ui.helper).collision ('.plotoverlay:visible', { mode: 'protrusion', directionData: 'direction', as: '<div/>' });
				var collisionDetected = false;
				if (collider.length >= 1) {
					$(collider).each (function () {
						if (($(this).data ('direction').indexOf ('E') != -1) || ($(this).data ('direction').indexOf ('W') != -1)) {
							collisionDetected = true;
						}
					});
				}
				if (collisionDetected) {
					$('#dialog-modal p').html ('Your item will fit but you will need to cut it. Cutting instructions available on our website.');
					$('#dialog-modal').dialog ({
						modal: true, 
						buttons: {
							Ok: function () {
								$(this).dialog ('close');
							}
						},
						position: 'center'
					});
				}
				if (checkOutOfBounds (ui.helper, currWall)) {
					$('#dialog-modal p').html ('You must leave a space of at least 16" from the edge in order to clear the item you placed on a another wall.');
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
				if (checkOutOfBoundary (ui.helper, currWall)) {
					$('#dialog-modal p').html ('Your item must be placed somewhere within the wall boundaries.');
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
				$(ui.helper).css ('border-color', 'transparent').css ('background-color', 'transparent');
				$(ui.helper).find ('div').css ('display', 'none');
			},
			containment: '#plotoverlaywide' + currWall
		});
		$('#plotoverlayA, #plotoverlayB, #plotoverlayC, #plotoverlayR').droppable ({
			drop: function (event, ui) {
				$.ui.ddmanager.current.cancelHelperRemoval = true;
			}
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
	$('.tbra').off ('click').on ('click', function () {
		if ($('.pics .itm:eq(5)').hasClass ('last')) {
			return false; // Prevent loop!
		}
		if ($('#overlay').css ('display') != 'none') {
			var img = lastOver.find ('.itmpic');
			// make it relatively positioned
			img.css ({'position': 'relative', 'left': '', 'top': ''});
			var txt = lastOver.find ('.txt');
			// make it relatively positioned
			txt.css ({'position': 'relative', 'left': '', 'top': ''});
			$('#overlay').css ('display', 'none');
			$('#selections').css ('display', 'none');
			$('.items .txt').removeClass ('nobottom').find ('.ardnc').css ('display', '');
			lastOver = null;
		}
		$('.pics .itm:first').insertAfter ($('.pics .itm:last'));
	});
	$('.tbla').off ('click').on ('click', function () {
		if ($('.pics .itm:first').hasClass ('first')) {
			return false; // Prevent loop!
		}
		if ($('#overlay').css ('display') != 'none') {
			var img = lastOver.find ('.itmpic');
			// make it relatively positioned
			img.css ({'position': 'relative', 'left': '', 'top': ''});
			var txt = lastOver.find ('.txt');
			// make it relatively positioned
			txt.css ({'position': 'relative', 'left': '', 'top': ''});
			$('#overlay').css ('display', 'none');
			$('#selections').css ('display', 'none');
			$('.items .txt').removeClass ('nobottom').find ('.ardnc').css ('display', '');
			lastOver = null;
		}
		$('.pics .itm:last').insertBefore ($('.pics .itm:first'));
	});
	$('.slider .wallout').off ('click').on ('click', function () {
		$('#wallcolor').css ('visibility', 'visible');
	});
	$('#wallcolor').off ('mouseover').on ('mouseover', function () {
		$(this).delay (50).css ('visibility', 'visible');
	}).off ('mouseout').on ('mouseout', function () {
		$(this).delay (50).css ('visibility', 'hidden');
	});
	$('#wallcolor .wallout').off ('click').on ('click', function () {
		backgroundStyle = $(this).attr ('title'); // set globally
		switch ($(this).attr ('title')) {
			case 'White':		$('.slider .wallout .pos').removeClass ('tbgb white charcoal lightgray').addClass ('white');
								break;
			case 'Charcoal':	$('.slider .wallout .pos').removeClass ('tbgb white charcoal lightgray').addClass ('charcoal');
								break;
			case 'Light gray':	$('.slider .wallout .pos').removeClass ('tbgb white charcoal lightgray').addClass ('lightgray');
								break;
		}
		if (configSelected == 'reach-in') {
			drawCanvas ('R', 1);
		} else {
			drawCanvas ('A', ($('.mid .btbg')[0].value == 'A' ? 1 : 0));
			drawCanvas ('B', ($('.mid .btbg')[0].value == 'B' ? 1 : 0));
			drawCanvas ('C', ($('.mid .btbg')[0].value == 'C' ? 1 : 0));
		}
		$('#wallcolor').css ('visibility', 'hidden');
	});
	$('.slider .itemout').off ('click').on ('click', function () {
		$('#itemcolor').css ('visibility', 'visible');
	});
	$('#itemcolor').off ('mouseover').on ('mouseover', function () {
		$(this).delay (50).css ('visibility', 'visible');
	}).off ('mouseout').on ('mouseout', function () {
		$(this).delay (50).css ('visibility', 'hidden');
	});
	$('#itemcolor .itemout').off ('click').on ('click', function () {
		var color = $(this).attr ('title');
		itemStyle = color; // set globally
		$('.slider .itemout .pos').removeClass ('tbgb itemwhite black red green orange').addClass ((itemStyle == 'White' ? 'itemwhite' : itemStyle.toLowerCase ()));
		$('.preview').attr ('data-color', color);
		$('.preview').each (function () {
			var tmpImg = $(this).css ('background-image').slice (4, $(this).css ('background-image').indexOf (')')).replace (/"/g, '');
			$(this).css ('background-image', 'url(' + tmpImg.replace (/(black|green|orange|red|white)/gi, color.toLowerCase ()) + ')');
		});
		$('#itemcolor').css ('visibility', 'hidden');
	});
	$('#plotoverlayA, #plotoverlayB, #plotoverlayC, #plotoverlayR').on ('click', function () {
		clearClickedSelections ();
	});

}

function clearClickedSelections () {
	$('body .preview.selected').each (function () {
		$(this).css ('border-color', 'transparent').css ('background-color', 'transparent');
		$(this).find ('div').css ('display', 'none');
		$(this).find ('span').css ('display', 'none');
		$(this).removeClass ('selected');
	});
}

function showDesigner () {
	savedWalls = [];
	$('.preview').remove (); // remove all existing items
	if (configSelected == 'walk-in') {
		$('#design .mid button')[0].innerHTML = ('Wall A (' + $('#metricsA .width')[0].value + '"x' + $('#metricsA .height')[0].value + '")');
		$('#design .mid button')[1].innerHTML = ('Wall B (' + $('#metricsB .width')[0].value + '"x' + $('#metricsB .height')[0].value + '")');
		$('#design .mid button')[2].innerHTML = ('Wall C (' + $('#metricsC .width')[0].value + '"x' + $('#metricsC .height')[0].value + '")');
	}
	$('.grid > div').html ('');
	if (configSelected == 'reach-in') {
		$('.wall' + $('#design .mid .btbg')[0].value).show ();
		$('#design .intro').html ('You are ready to start designing; click and drag your accessories onto the grid below.');
		$('.mid button:first-child').click ();
		$('.mid').hide ();
		drawCanvas ('R', 1);
	} else {
		$('.wallR').show ();
		$('#design .intro').html ('You are ready to start designing; click and drag your accessories onto the grids of walls A,B,C.');
		$('.mid button')[1].click ();
		$('.mid').show ();
		drawCanvas ('A', 0);
		drawCanvas ('B', 1); // B is visible
		drawCanvas ('C', 0);
	}
	loadCanvasEvents (); // load events
	$('#design').show ();
}

function initButtonBar () {
	$('.reach-in').on ('click', function () {
		$(this).closest ('.outer').hide ();
		$('#reach-in').show ();
		configSelected = 'reach-in';
	});
	$('.walk-in').on ('click', function () {
		$(this).closest ('.outer').hide ();
		$('#walk-in').show ();
		configSelected = 'walk-in';
	});
	$('#walk-in .prev, #reach-in .prev').on ('click', function () {
		$(this).closest ('.outer').hide ();
		$('#welcome').show ();
	});
	$('#walk-in .next, #reach-in .next').on ('click', function () {
		$(this).closest ('.outer').hide ();
		showDesigner ();
	});
	$('#design .prev').on ('click', function () {
		$(this).closest ('.outer').hide ();
		var currWall = (configSelected == 'reach-in' ? 'R' : $('#design .mid .btbg')[0].value);
		$('.wall' + currWall).hide ();
		$('#' + configSelected).show ();
	});
	$('#design .next').on ('click', function () {
		displayShoppingList ();
		$('.preview').hide ();
		$(this).closest ('.outer').hide ();
		$('#shopping_list').show ();
	});
	$('#design .save').on ('click', function () {
		$('#dialog-modal p').html ('Enter your email address to save your progress. We\'ll email you a link so you can access this page again in future.<br /><br /><form><label for="saveEmail">Email Address</label><br /><input type="email" id="saveEmail" style="width: 80%" class="text ui-widget-content ui-corner-all" /></form>').keypress (function (e) {
			var charCode = e.charCode || e.keyCode;
			if (charCode  == 13) {
				return false;
			}
		});
		$('#dialog-modal').dialog ({
			modal: true, 
			buttons: {
				"Save": function () {
					if ($('#saveEmail').val () == '') {
						$('#saveEmail').css ('border', '1px solid red'); $('#saveEmail').focus (); return false;
					}
					saveWalls ();
					$.post ('save.php', { json: JSON.stringify (savedWalls), action: 'saveProgress', recipient: $('#saveEmail').val () }).done (function (data) {
						$('#dialog-modal').dialog ('close');
						$('#dialog-modal p').html ('Your progress has been saved. Copy this link and use it whenever you need to access this page.<br /><br /><form><input type="text" id="savedLink" style="width: 80%" class="text ui-widget-content ui-corner-all" value="' + data + '" /></form>');
						$('#dialog-modal').dialog ({
							modal: true, 
							buttons: {
								"Close": function () {
									$(this).dialog ('close');
								}
							},
							position: 'center',
							title: 'Progress Saved'
						});
					});
				},
				"Cancel": function () {
					$(this).dialog ('close');
				}
			},
			position: 'center',
			title: 'Save Your Progress'
		});
	});
	$('#shopping_list .prev').on ('click', function () {
		var currWall = (configSelected == 'reach-in' ? 'R' : $('.mid .btbg')[0].value);
		$(this).closest ('.outer').hide ();
		$('.preview.wall' + currWall).show ();
		$('#design').show ();
	});
	$('#shopping_list .save').on ('click', function () {
		saveWalls ();
		$.post ('save.php', { json: JSON.stringify (savedWalls), action: 'saveQuote' }).done (function (data) {
			window.open (data);
		});
	});
	$('#shopping_list .retail').on ('click', function () {
		$('#dialog-modal p').html ('Enter your name and email address, and we\'ll send your quote via email.<br /><br /><form><label for="quoteName">Full Name</label><br /><input type="text" id="quoteName" style="width: 80%" class="text ui-widget-content ui-corner-all" /><br /><label for="quoteEmail">Email Address</label><br /><input type="email" id="quoteEmail" style="width: 80%" class="text ui-widget-content ui-corner-all" /></form>').keypress (function (e) {
			var charCode = e.charCode || e.keyCode;
			if (charCode  == 13) {
				return false;
			}
		});
		$('#dialog-modal').dialog ({
			modal: true, 
			buttons: {
				"Send Quote": function () {
					if ($('#quoteEmail').val () == '') {
						$('#quoteEmail').css ('border', '1px solid red'); $('#quoteEmail').focus (); return false;
					}
					// Don't resave walls
					$.post ('save.php', { json: JSON.stringify (savedWalls), action: 'sendQuote', recipient: $('#quoteEmail').val (), name: $('#quoteName').val () }).done (function (data) {
						$('#dialog-modal').dialog ('close');
						$('#dialog-modal p').html ('Thank you, your quote has been emailed to the address you supplied.');
						$('#dialog-modal').dialog ({
							modal: true, 
							buttons: {
								"Close": function () {
									$(this).dialog ('close');
								}
							},
							position: 'center',
							title: 'Thank You'
						});
					});
				},
				"Cancel": function () {
					$(this).dialog ('close');
				}
			},
			position: 'center',
			title: 'Get a Quote'
		});
	});
}

function initDimensionBoxes () {
	$('input').numeric ().on ('keyup', function () {
		var min = ($(this).hasClass ('width') ? 24 : 16);
		var max = ($(this).hasClass ('width') ? 240 : 120);
		var val = (parseInt ($(this)[0].value) ? parseInt ($(this)[0].value) : 0);
		if ((val < min) || (val > max)) {
			$(this).css ('border-color', 'red');
		} else {
			$(this).css ('border-color', 'transparent');
		}
	}).on ('blur', function () {
		var min = ($(this).hasClass ('width') ? 24 : 16);
		var max = ($(this).hasClass ('width') ? 240 : 120);
		var val = (parseInt ($(this)[0].value) ? parseInt ($(this)[0].value) : 0);
		if (val < min) {
			$(this)[0].value = min;
		} else
		if (val > max) {
			$(this)[0].value = max;
		}
		$(this).css ('border-color', 'transparent');
	});
}

function displayShoppingList () {
	$('#shopping_list .paint').html ('');
	if (configSelected == 'reach-in') {
		cloneWall ('R');
	} else {
		cloneWall ('A');
		cloneWall ('B');
		cloneWall ('C');
		totalWall ();
	}
	saveWalls ();
}

//--- Execution starts here
$(document).ready(function () {
	initButtonBar ();
	initDimensionBoxes ();
	$('#design .mid button').on ('click', function () {
		var currWall = $('#design .mid .btbg')[0].value;
		var nextWall = $(this)[0].value;
		saveWallBoundaries (currWall);
		$('#plot' + currWall).hide ();
		$('#plotoverlay' + currWall).hide ();
		$('#plot' + nextWall).show ();
		$('#plotoverlay' + nextWall).show ();
		$('.wall' + currWall).hide ();
		$('.wall' + nextWall).show ();
		$('.mid button').toggleClass ('btbg', false).toggleClass ('tbgb', true);
		$(this).toggleClass ('btbg', true);
	});
});

//--- Global settings (probably should be inside a class)
var lastOver = null;
var configSelected = null;
//--- Store scale info for each wall
var wallScale = {
	A: [1, 1],
	B: [1, 1], 
	C: [1, 1]
};
//--- Store boundary test information (left wall, right wall)
var wallBoundaryTests = {
	A: [false, false],
	B: [false, false],
	C: [false, false]
}

//--- Default colors for wall and item
var backgroundStyle = 'White';
var itemStyle = 'White';

//--- This variable stores the latest shopping list
var savedWalls = {};

//--- Edit this list with details of each product. The numbers (39101, 39201, etc) represent
//--- the SKU code referenced by the data-sku attribute. The 'desc' attribute is for the shopping
//--- list, while the 'options' attribute indicates prices and colors available for that item
var shoppingLookup = {
	39101: {
		desc: '24" shelf w/ pole', 
		options: [
			[39101, 'White', '782088391019', 74.99], 
			[39102, 'Black', '782088391026', 74.99], 
			[39103, 'Red', '782088391033', 74.99], 
			[39104, 'Green', '782088391040', 74.99], 
			[39105, 'Orange', '782088391057', 74.99]
		] 
	}, 
	39201: {
		desc: '24" shelf', 
		options: [
			[39201, 'White', '782088392016', 64.99], 
			[39202, 'Black', '782088392023', 64.99], 
			[39203, 'Red', '782088392030', 64.99], 
			[39204, 'Green', '782088392047', 64.99], 
			[39205, 'Orange', '782088392054', 64.99]
		]
	}, 
	39301: {
		desc: 'Basket w/ shelf', 
		options: [
			[39301, 'White', '782088393013', 99.99], 
			[39302, 'Black', '782088393020', 99.99], 
			[39303, 'Red', '782088393037', 99.99], 
			[39304, 'Green', '782088393044', 99.99], 
			[39305, 'Orange', '782088393051', 99.99]
		]
	}, 
	39401: {
		desc: '48" shelf w/ pole', 
		options: [
			[39401, 'White', '782088394010', 124.99], 
			[39402, 'Black', '782088394027', 124.99], 
			[39403, 'Red', '782088394034', 124.99], 
			[39404, 'Green', '782088394041', 124.99], 
			[39405, 'Orange', '782088394058', 124.99]
		]
	}, 
	39501: {
		desc: '48" shelf', 
		options: [
			[39501, 'White', '782088395017', 109.99], 
			[39502, 'Black', '782088395024', 109.99], 
			[39503, 'Red', '782088395031', 109.99], 
			[39504, 'Green', '782088395048', 109.99], 
			[39505, 'Orange', '782088395055', 109.99]
		]
	}, 
	30008: {
		desc: 'Universal cascade', 
		options: [
			[30008, 'Chrome', '782088390081', 13.99]
		]
	}, 
	39009: {
		desc: 'Shoe rack', 
		options: [
			[39009, 'Chrome', '782088390098', 14.99]
		]
	}, 
	30011: {
		desc: 'Basket', 
		options: [
			[30011, 'Chrome', '782088300111', 69.99]
		]
	}, 
	30012: {
		desc: 'Pant rack  w/rubber sleeves', 
		options: [
			[30012, 'Chrome', '782088300128', 49.99]
		]
	}, 
	39016: {
		desc: '10" straight bar', 
		options: [
			[39016, 'Chrome', '782088390166', 8.99]
		]
	}, 
	39017: {
		desc: 'Shoe shelf', 
		options: [
			[39017, 'Chrome', '782088390173', 14.99]
		]
	}, 
	30018: {
		desc: '24" U bar', 
		options: [
			[30018, 'Chrome', '782088390180', 39.99]
		]
	}, 
	30019: {
		desc: '48" U bar', 
		options: [
			[30019, 'Chrome', '782088390197', 79.99]
		]
	}, 
	39020: {
		desc: 'Fixed basket', 
		options: [
			[39020, 'Chrome', '782088390203', 34.99]
		]
	}
}