<?php
/*
 * Simple script to render the EvoliaCloset shopping list
 */
include_once ("lib.php");

$db = new DB ();
$walls = $db->getJSON ($_GET['id']);
?>
<html>
	<head>
		<title>Shopping List</title>
		<link rel="stylesheet" href="style.css" />
		<script src="jquery-1.8.3.min.js"></script>
		<script src="numeric.js" /></script>
		<script src="init.js" /></script>
	</head>

	<body>
		<div id="print">Your shopping list is displayed below. You can now <a href="#" onclick="window.print (); return false;">print it</a> or <a href="http://pdfcrowd.com/url_to_pdf/?use_print_media=1">save it to PDF</a></div>
		<div id="shopping_list"></div>
	</body>
	<script>
<?
$boxCount = (count ($walls) == 3 ? 
			($walls[0]->wFeet <= 96 ? 1 : ($walls[0]->wFeet <= 192 ? 2 : 3)) + 
			($walls[1]->wFeet <= 96 ? 1 : ($walls[1]->wFeet <= 192 ? 2 : 3)) + 
			($walls[2]->wFeet <= 96 ? 1 : ($walls[2]->wFeet <= 192 ? 2 : 3)) : 
			($walls[0]->wFeet <= 96 ? 1 : ($walls[0]->wFeet <= 192 ? 2 : 3)));
$products = array ();
for ($i = 0; $i < count ($walls); $i++) {
	echo "printWall ('".$walls[$i]->label."', ".$walls[$i]->wFeet.", ".$walls[$i]->hFeet.", '".$walls[$i]->backgroundStyle."', JSON.parse ('".json_encode ($walls[$i]->products)."'));\n";
	$products = array_merge ($products, $walls[$i]->products);
}
if (count ($walls) == 3) {
	echo "printTotalWall ('".$walls[0]->backgroundStyle."', $boxCount, JSON.parse ('".json_encode ($products)."'));\n";
}
?>
	</script>
</html>