<?php
/*
 * Classes
 */

class Product {

	public $src;
	public $left;
	public $top;
	public $sku;
	public $color;

	public function __construct ($src, $left, $top, $sku, $color) {
		$this->src = $src;
		$this->left = $left;
		$this->top = $top;
		$this->sku = $sku;
		$this->color = $color;
	}

}

class Wall {

	public $backgroundStyle;
	public $label;
	public $wFeet;
	public $hFeet;
	public $products = array ();

	public function __construct ($label, $backgroundStyle = 'White', $wFeet = 192, $hFeet = 96) {
		$this->label = $label;
		$this->backgroundStyle = $backgroundStyle;
		$this->wFeet = $wFeet;
		$this->hFeet = $hFeet;
	}

	public function addProduct ($src, $left, $top, $sku, $color) {
		array_push ($this->products, new Product ($src, $left, $top, $sku, $color));
	}

}

class DB {

	public $mysqli;

	public function __construct () {
		$this->mysqli = new mysqli ("localhost", "<login>", "<password>", "<db>");
		if ($this->mysqli->connect_errno) {
			echo "Failed to connect to MySQL: " . $this->mysqli->connect_error; die ();
		}
	}

	public function putJSON ($obj) {
		$id = md5 (time ()); // random 32 digits
		$sql = "INSERT INTO shoppinglists (id, json) values ('$id', '".(is_string ($obj) ? $obj : json_encode ($obj))."')";
		$this->mysqli->query ($sql);
		return $id;
	}

	public function getJSON ($id) {
		$sql = "SELECT json FROM shoppinglists WHERE id = '$id'";
		$res = $this->mysqli->query ($sql);
		$row = $res->fetch_assoc ();
		return json_decode ($row['json']);
	}

}
?>
