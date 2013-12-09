<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Evolia Closet - Flash to HTML</title>
		<!-- 
		Copyright (C) 2013, J. Ginsberg. All rights reserved.
		This code cannot be copied or distributed without the copyright holder's explicit permission
		-->
		<link rel="stylesheet" href="style.css" />
		<link rel="stylesheet" href="ui/jquery-ui.min.css" />
		<script src="jquery-1.8.3.min.js"></script>
		<script src="ui/jquery.ui.core.js"></script>
		<script src="ui/jquery.ui.widget.js"></script>
		<script src="ui/jquery.ui.mouse.js"></script>
		<script src="ui/jquery.ui.position.js"></script>
		<script src="ui/jquery.ui.dialog.js"></script>
		<script src="ui/jquery.ui.draggable.js"></script>
		<script src="ui/jquery.ui.droppable.js"></script>
		<script src="ui/jquery.ui.touch-punch.min.js"></script>
		<script src="jquery-collision.min.js"></script>
		<script src="microfiche.js" /></script>
		<script src="numeric.js" /></script>
		<script src="init.js" /></script>
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

		<div class="outer" id="welcome">
			<div class="welcome">Welcome to Evolia's design center</div>
			<div class="welcome_instructions">Please click below on your closet configuration</div>
			<div class="select_boxes">
				<img class="reach-in" src="reach-in.png" />
				<img class="walk-in" src="walk-in.png" />
			</div>
		</div>
		<div class="outer" id="reach-in" style="display: none;">
			<div class="tb">
				<div class="tbgb intro">
					Enter the width and height of your back wall in the boxes below.
				</div>
			</div>
			<div class="paint">
				<div>
					<div style="margin-left: 106px; margin-top: 88px; border-radius: 4px; border: 1px solid #15487a; width: 745px; height: 399px; background: #3780B7">
						<div style="font-family: Arial; font-weight: normal; font-size: 43px; color: white; margin-top: 33px; text-align: center; text-shadow: 0 -1px 0 #888; letter-spacing: 2px;">Reach In</div>
						<div style="margin: 48px 0 0 79px; float: left;"><img src="reach-in-closet.png" /></div>
						<div id="metricsR" style="float: left; margin: 101px 0 0 59px; color: white;">
							<div style="float: left; font-family: Arial; font-size: 18px; font-weight: bold; margin: 40px 26px 0 0;">Back wall</div>
							<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center; margin-right: 20px;">Width (inches)<div style="margin-top: 5px;"><input type="text" class="tbgb width" maxlength="3" value="192" /></div></div>
							<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center;">Height (inches)<div style="margin-top: 5px;"><input type="text" class="tbgb height" maxlength="3" value="96" /></div></div>
						</div>
					</div>
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
				</div>
			</div>
		</div>
		<div class="outer" id="walk-in" style="display: none;">
			<div class="tb">
				<div class="tbgb intro">
					Enter the width and height of each of the three walls in the boxes below.
				</div>
			</div>
			<div class="paint">
				<div>
					<div style="margin-left: 106px; margin-top: 88px; border-radius: 4px; border: 1px solid #15487a; width: 745px; height: 399px; background: #3780B7">
						<div style="font-family: Arial; font-weight: normal; font-size: 43px; color: white; margin-top: 33px; text-align: center; text-shadow: 0 -1px 0 #888; letter-spacing: 2px;">Walk In</div>
						<div style="margin: 39px 0 0 32px; float: left;"><img src="walk-in-closet.png" /></div>
						<div style="float: left; margin: 62px 0 0 47px; color: white;">
							<div id="metricsA" style="overflow: hidden; border-bottom: 1px solid #3174a8; padding-bottom: 6px;">
								<div style="float: left; font-family: Arial; font-size: 18px; font-weight: bold; margin: 40px 26px 0 0;">Wall A</div>
								<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center; margin-right: 20px;">Width (inches)<div style="margin-top: 5px;"><input type="text" class="tbgb width" maxlength="3" value="192" /></div></div>
								<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center;">Height (inches)<div style="margin-top: 5px;"><input type="text" class="tbgb height" maxlength="3" value="96" /></div></div>
							</div>
							<div id="metricsB" style="overflow: hidden; border-top: 1px solid #5492c2; border-bottom: 1px solid #3174a8; padding: 4px 0 6px 0;">
								<div style="float: left; font-family: Arial; font-size: 18px; font-weight: bold; margin: 12px 26px 0 0;">Wall B</div>
								<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center; margin-right: 20px;"><div style="margin-top: 5px;"><input type="text" class="tbgb width" maxlength="3" value="192" /></div></div>
								<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center;"><div style="margin-top: 5px;"><input type="text" class="tbgb height" maxlength="3" value="96" /></div></div>
							</div>
							<div id="metricsC" style="overflow: hidden; border-top: 1px solid #5492c2; padding-top: 4px;">
								<div style="float: left; font-family: Arial; font-size: 18px; font-weight: bold; margin: 12px 26px 0 0;">Wall C</div>
								<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center; margin-right: 20px;"><div style="margin-top: 5px;"><input type="text" class="tbgb width" maxlength="3" value="192" /></div></div>
								<div style="float: left; font-family: Arial; font-size: 12px; width: 64px; text-align: center;"><div style="margin-top: 5px;"><input type="text" class="tbgb height" maxlength="3" value="96" /></div></div>
							</div>
						</div>
					</div>
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
				</div>
			</div>
		</div>
		<div class="outer drag" id="design" style="display: none;">
			<div class="tb">
				<div class="tbgb intro">
					You are ready to start designing; click and drag your accessories onto the grids of walls A,B,C.
				</div>
			</div>
			<div class="slider">
				<div class="inner">
					<div class="items">
						<div class="tbla" onselectstart="return false;"><div class="arlt"></div></div>
						<div class="pics">
							<div>
								<div class="itm first">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/24_shelf_shirts_black.png" /></div><div class="txt"><div class="val">Shirts (Folded)</div><div class="ardnc"></div></div>
									<dl class="wide">
										<dd data-sku="39201" data-helper="FRONT/24_shelf_shirts_black.png" data-helper-w="24.5" data-helper-h="11.5" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_shelf_shirts_black.png" /></div><div>24" SHELF</div></dd>
										<dd data-sku="39501" data-helper="FRONT/48_shelf_shirts_black.png" data-helper-w="48" data-helper-h="13"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_shelf_shirts_black.png" /></div><div>48" SHELF</div></dd>
										<dd data-sku="30011" data-helper="FRONT/basket_full.png" data-helper-w="24.5" data-helper-h="10.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/basket_full.png" /></div><div>BASKET</div></dd>
										<dd data-sku="39301" data-helper="FRONT/basket_shelf_full_black.png" data-helper-w="24.5" data-helper-h="10.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/basket_shelf_full_black.png" /></div><div>BASKET W/ SHELF</div></dd>
										<dd data-sku="39020" data-helper="FRONT/fixed_basket_full.png" data-helper-w="24" data-helper-h="9"><div class="helperouter"><span class="helper"></span><img src="FRONT/fixed_basket_full.png" /></div><div>FIXED BASKET</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/10_bar_shirts.png" /></div><div class="txt"><div class="val">Shirts (Hanging)</div><div class="ardnc"></div></div>
									<dl class="wide">
										<dd data-sku="39101" data-helper="FRONT/24_shelf_pole_shirts_black.png" data-helper-w="25" data-helper-h="39"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_shelf_pole_shirts_black.png" /></div><div>24" SHELF W/ POLE</div></dd>
										<dd data-sku="39401" data-helper="FRONT/48_shelf_pole_shirts_black.png" data-helper-w="48" data-helper-h="41"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_shelf_pole_shirts_black.png" /></div><div>48" SHELF W/ POLE</div></dd>
										<dd data-sku="30018" data-helper="FRONT/24_u_bar_shirts.png" data-helper-w="24.5" data-helper-h="40.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_u_bar_shirts.png" /></div><div>24" U BAR</div></dd>
										<dd data-sku="30019" data-helper="FRONT/48_u_bar_shirts.png" data-helper-w="48" data-helper-h="42.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_u_bar_shirts.png" /></div><div>48" U BAR</div></dd>
										<dd data-sku="30008" data-helper="FRONT/cascade_shirts.png" data-helper-w="22" data-helper-h="43.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/cascade_shirts.png" /></div><div>CASCADE</div></dd>
										<dd data-sku="39016" data-helper="FRONT/10_bar_shirts.png" data-helper-w="19.5" data-helper-h="32" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/10_bar_shirts.png" /></div><div>10" STRAIGHT BAR</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/10_bar_dresses.png" /></div><div class="txt"><div class="val">Dresses</div><div class="ardnc"></div></div>
									<dl class="wide">
										<dd data-sku="39101" data-helper="FRONT/24_shelf_pole_dresses_black.png" data-helper-w="24.5" data-helper-h="51.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_shelf_pole_dresses_black.png" /></div><div>24" SHELF W/ POLE</div></dd>
										<dd data-sku="39401" data-helper="FRONT/48_shelf_pole_dresses_black.png" data-helper-w="48" data-helper-h="52"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_shelf_pole_dresses_black.png" /></div><div>48" SHELF W/ POLE</div></dd>
										<dd data-sku="30018" data-helper="FRONT/24_u_bar_dresses.png" data-helper-w="24" data-helper-h="53.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_u_bar_dresses.png" /></div><div>24" U BAR</div></dd>
										<dd data-sku="30019" data-helper="FRONT/48_u_bar_dresses.png" data-helper-w="48" data-helper-h="56.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_u_bar_dresses.png" /></div><div>48" U BAR</div></dd>
										<dd data-sku="30008" data-helper="FRONT/cascade_dresses.png" data-helper-w="18.5" data-helper-h="60"><div class="helperouter"><span class="helper"></span><img src="FRONT/cascade_dresses.png" /></div><div>CASCADE</div></dd>
										<dd data-sku="39016" data-helper="FRONT/10_bar_dresses.png" data-helper-w="19" data-helper-h="46" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/10_bar_dresses.png" /></div><div>10" STRAIGHT BAR</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/fixed_basket_pants.png" /></div><div class="txt"><div class="val">Pants (Folded)</div><div class="ardnc"></div></div>
									<dl class="wide">
										<dd data-sku="39201" data-helper="FRONT/24_shelf_pants_black.png" data-helper-w="24.5" data-helper-h="11.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_shelf_pants_black.png" /></div><div>24" SHELF</div></dd>
										<dd data-sku="39501" data-helper="FRONT/48_shelf_pants_black.png" data-helper-w="48" data-helper-h="12.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_shelf_pants_black.png" /></div><div>48" SHELF</div></dd>
										<dd data-sku="30011" data-helper="FRONT/basket_full.png" data-helper-w="24.5" data-helper-h="10.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/basket_full.png" /></div><div>BASKET</div></dd>
										<dd data-sku="39301" data-helper="FRONT/basket_shelf_full_black.png" data-helper-w="24.5" data-helper-h="10.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/basket_shelf_full_black.png" /></div><div>BASKET W/ SHELF</div></dd>
										<dd data-sku="39020" data-helper="FRONT/fixed_basket_pants.png" data-helper-w="24" data-helper-h="9" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/fixed_basket_pants.png" /></div><div>FIXED BASKET</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/pant_rack.png" /></div><div class="txt"><div class="val">Pants (Hanging)</div><div class="ardnc"></div></div>
									<dl class="wide">
										<dd data-sku="39101" data-helper="FRONT/24_shelf_pole_pants_black.png" data-helper-w="24.5" data-helper-h="42"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_shelf_pole_pants_black.png" /></div><div>24" SHELF W/ POLE</div></dd>
										<dd data-sku="39401" data-helper="FRONT/48_shelf_pole_pants_black.png" data-helper-w="48" data-helper-h="42"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_shelf_pole_pants_black.png" /></div><div>48" SHELF W/ POLE</div></dd>
										<dd data-sku="30018" data-helper="FRONT/24_u_bar_pants.png" data-helper-w="25.75" data-helper-h="46"><div class="helperouter"><span class="helper"></span><img src="FRONT/24_u_bar_pants.png" /></div><div>24" U BAR</div></dd>
										<dd data-sku="30019" data-helper="FRONT/48_u_bar_pants.png" data-helper-w="48" data-helper-h="45"><div class="helperouter"><span class="helper"></span><img src="FRONT/48_u_bar_pants.png" /></div><div>48" U BAR</div></dd>
										<dd data-sku="30012" data-helper="FRONT/pant_rack.png" data-helper-w="24" data-helper-h="36" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/pant_rack.png" /></div><div>PANT RACK</div></dd>
										<dd data-sku="39016" data-helper="FRONT/10_bar_pants.png" data-helper-w="17.5" data-helper-h="34.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/10_bar_pants.png" /></div><div>10" STRAIGHT BAR</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/shoe_shelf_lifestyle.png" /></div><div class="txt"><div class="val">Shoes</div><div class="ardnc"></div></div>
									<dl>
										<dd data-sku="39017" data-helper="FRONT/shoe_shelf_lifestyle.png" data-helper-w="12" data-helper-h="9" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/shoe_shelf_lifestyle.png" /></div><div>SHOE SHELF (1 PR)</div></dd>
										<dd data-sku="39009" data-helper="FRONT/shoe_rack_lifestyle.png" data-helper-w="8.5" data-helper-h="14.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/shoe_rack_lifestyle.png" /></div><div>SHOE RACK (3 PRS)</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/basket_shelf_full_black.png" /></div><div class="txt"><div class="val">Undergarments</div><div class="ardnc"></div></div>
									<dl>
										<dd data-sku="30011" data-helper="FRONT/basket_full.png" data-helper-w="24.5" data-helper-h="11.5"><div class="helperouter"><span class="helper"></span><img src="FRONT/basket_full.png" /></div><div>BASKET</div></dd>
										<dd data-sku="39301" data-helper="FRONT/basket_shelf_full_black.png" data-helper-w="24.5" data-helper-h="10.5" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/basket_shelf_full_black.png" /></div><div>BASKET W/ SHELF</div></dd>
										<dd data-sku="39020" data-helper="FRONT/fixed_basket_full.png" data-helper-w="24" data-helper-h="9"><div class="helperouter"><span class="helper"></span><img src="FRONT/fixed_basket_full.png" /></div><div>FIXED BASKET</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/cascade_bags.png" /></div><div class="txt"><div class="val">Bags</div><div class="ardnc"></div></div>
									<dl>
										<dd data-sku="30008" data-helper="FRONT/cascade_bags.png" data-helper-w="16" data-helper-h="36" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/cascade_bags.png" /></div><div>CASCADE</div></dd>
										<dd data-sku="39016" data-helper="FRONT/10_bar_bags.png" data-helper-w="16" data-helper-h="26"><div class="helperouter"><span class="helper"></span><img src="FRONT/10_bar_bags.png" /></div><div>10" STRAIGHT BAR</div></dd>
										<dd data-sku="" data-helper="FRONT/4_hook_bags.png" data-helper-w="16" data-helper-h="25"><div class="helperouter"><span class="helper"></span><img src="FRONT/4_hook_bags.png" /></div><div>4" HOOK</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
								<div class="itm last">
									<div class="helperouter"><span class="helper"></span><img class="itmpic" src="FRONT/cascade_belts.png" /></div><div class="txt"><div class="val">Belts/Scarfs/Ties</div><div class="ardnc"></div></div>
									<dl>
										<dd data-sku="30008" data-helper="FRONT/cascade_belts.png" data-helper-w="9.5" data-helper-h="43" class="selected"><div class="helperouter"><span class="helper"></span><img src="FRONT/cascade_belts.png" /></div><div>CASCADE</div></dd>
										<dd data-sku="" data-helper="FRONT/4_hook_belts.png" data-helper-w="2.5" data-helper-h="44"><div class="helperouter"><span class="helper"></span><img src="FRONT/4_hook_belts.png" /></div><div>4" HOOK</div></dd>
										<dd><div>Drag item on your wall</div></dd>
									</dl>
								</div>
							</div>
						</div>
						<div class="tbra" onselectstart="return false;"><div class="arrt"></div></div>
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
								<div class="tbgb pos"><div class="ardnb"></div><div class="ardna"></div></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="grid">
				<div>
					<!-- Canvases go here -->
				</div>
			</div>
			<div class="btnbar">
				<div class="inner">
					<div class="mid">
						<button class="tbgb" value="A">Wall A (192"x96")</button>
						<button class="btbg" value="B">Wall B (192"x96")</button>
						<button class="tbgb" value="C">Wall C (192"x96")</button>
					</div>
					<div class="left">
						<button class="tbgb prev">Previous step</button>
					</div>
					<div class="right">
						<button class="tbgb next">Next Step</button>
					</div>
				</div>
			</div>
		</div>
		<div class="outer" id="shopping_list" style="display: none;">
			<div class="tb">
				<div class="tbgb intro">
					Here is your shopping list!
				</div>
			</div>
			<div class="paint" style="background-color: #eee; overflow: scroll; height: 586px"></div>
			<div class="btnbar">
				<div class="inner">
					<div class="left">
						<button class="tbgb prev">Previous step</button>
					</div>
					<div class="right">
						<button class="tbgb retail">Get a Quote</button>
						<button class="tbgb save">Save</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Popover objects -->
		<div id="overlay" style="display: none; position: absolute; z-index: 20; border: 1px solid #2a7bb4; border-bottom: none; top: 33px; left: 0px; width: 128px; height: 100px; background-color: #fff"></div>
		<div id="selections" style="display: none; position: absolute; z-index: 20; border: 1px solid #2a7bb4; border-top: none; top: 134px; left: 0px; background-color: #fff"></div>
		<div id="dialog-modal" title="Warning" style="display: none;"><p>Message</p></div>
		<div id="wallcolor" class="tbgb">
			<div class="buttons" style="padding: 1px 0">
				<div class="wallcol" style="color: #000; text-shadow: none;">Wall Color</div>
				<div class="wallout" style="margin-bottom: 0" title="White">
					<div class="inner">
						<div class="white pos"></div>
					</div>
				</div>
				<div class="wallout" style="margin-bottom: 0" title="Charcoal">
					<div class="inner">
						<div class="charcoal pos"></div>
					</div>
				</div>
				<div class="wallout" title="Light gray">
					<div class="inner">
						<div class="lightgray pos"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="itemcolor" class="tbgb">
			<div class="buttons" style="padding: 1px 0">
				<div class="itemcol" style="color: #000; text-shadow: none;">Item Color</div>
				<div class="itemout" style="margin-bottom: 0" title="White">
					<div class="inner">
						<div class="white pos"></div>
					</div>
				</div>
				<div class="itemout" style="margin-bottom: 0" title="Black">
					<div class="inner">
						<div class="black pos"></div>
					</div>
				</div>
				<div class="itemout" style="margin-bottom: 0" title="Red">
					<div class="inner">
						<div class="red pos"></div>
					</div>
				</div>
				<div class="itemout" style="margin-bottom: 0" title="Green">
					<div class="inner">
						<div class="green pos"></div>
					</div>
				</div>
				<div class="itemout" style="margin-bottom: 6px" title="Orange">
					<div class="inner">
						<div class="orange pos"></div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
