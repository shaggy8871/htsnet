<?php
/*
 * Simple script to save the EvoliaCloset shopping list and call PDFcrowd
 * We expect data in the correct format for simpler processing
 */
include_once ("lib.php");

$db = new DB ();
$id = $db->putJSON ($_POST['json']);
echo $id; // just output the identifier
?>
