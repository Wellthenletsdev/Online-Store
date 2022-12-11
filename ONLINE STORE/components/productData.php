<?php

// A collection of sample products
$products = json_decode('[{"id":100,"name":"Eagle BBS ","image":{"source":"./rims/rim1.jpg","width":200,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray","rose-gold":"Rose Gold"},"price":"349.00"},
{"id":101,"name":"Gusheshe Reps","image":{"source":"./rims/rims2.jpg","width":200,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray","rose-gold":"Rose Gold"},"price":"449.00"},
{"id":102,"name":"Porsche Reps","image":{"source":"./rims/rim3.jpg","width":157,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray","rose-gold":"Rose Gold"},"price":"449.00"},
{"id":103,"name":"Lamboghini Reps","image":{"source":"./rims/rim4.jpg","width":157,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray","rose-gold":"Rose Gold"},"price":"549.00"},
{"id":104,"name":"GOLF Reps","image":{"source":"./rims/rim5.jpg","width":158,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray","rose-gold":"Rose Gold"},"price":"549.00"},
{"id":105,"name":"VR6 reps","image":{"source":"./rims/rim6.jpg","width":158,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray","rose-gold":"Rose Gold"},"price":"649.00"},
{"id":106,"name":"MARK 1 ORIGINAL","image":{"source":"./rims/rim7.jpg","width":182,"height":250},"colors":{"jet-black":"Jet Black","black":"Black","silver":"Silver","gold":"Gold","rose-gold":"Rose Gold"},"price":"549.00"},
{"id":107,"name":"VW Reps","image":{"source":"./rims/rim8.jpg","width":182,"height":250},"colors":{"jet-black":"Jet Black","black":"Black","silver":"Silver","gold":"Gold","rose-gold":"Rose Gold"},"price":"649.00"},
{"id":108,"name":"BMW Reps","image":{"source":"./rims/rim9.jpg","width":178,"height":250},"colors":{"jet-black":"Jet Black","black":"Black","silver":"Silver","gold":"Gold","rose-gold":"Rose Gold"},"price":"669.00"},
{"id":109,"name":"Cobra Originals","image":{"source":"./rims/rim1.jpg","width":178,"height":250},"colors":{"jet-black":"Jet Black","black":"Black","silver":"Silver","gold":"Gold","rose-gold":"Rose Gold"},"price":"769.00"},
{"id":110,"name":"GOLF 1 REPS","image":{"source":"./rims/rims2.jpg","width":182,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray"},"price":"699.00"},
{"id":111,"name":"MERC C200 ORIGINALS","image":{"source":"./rims/rim3.jpg","width":182,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray"},"price":"799.00"},
{"id":112,"name":"Toyota Hilux Reps","image":{"source":"./rims/rim4.jpg","width":177,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray"},"price":"799.00"},
{"id":113,"name":"Wheel Spanner","image":{"source":"./rims/car spanner.jpg","width":177,"height":250},"colors":{"silver":"Silver","gold":"Gold","space-gray":"Space Gray"},"price":"949.00"},
{"id":114,"name":"SHOCKS ","image":{"source":"./rims/carshocks.jpg","width":252,"height":250},"colors":[],"price":"179.00"},
{"id":115,"name":"Lowering Springs","image":{"source":"./rims/loweringsprings.jpg","width":252,"height":250},"colors":[],"price":"199.00"}]');

$colors = [
	'black'      => 'Black',
	'space-gray' => 'Space Gray',
	'jet-black'  => 'Jet Black',
	'silver'     => 'Silver',
	'gold'       => 'Gold',
	'rose-gold'  => 'Rose Gold',
];

// Page
$a = (isset($_GET['a'])) ? $_GET['a'] : 'home';

require_once 'class.Cart.php';

// Initialize cart object
$cart = new Cart([
	// Maximum item can added to cart, 0 = Unlimited
	'cartMaxItem' => 0,

	// Maximum quantity of a item can be added to cart, 0 = Unlimited
	'itemMaxQuantity' => 5,

	//KEEP MY CART DATA
	'useCookie' => true,
]);

// Shopping Cart Page
if ($a == 'cart') {
	$cartContents = '
	<div class="alert alert-warning">
		<i class="fa fa-info-circle"></i> There are no items in the cart.
	</div>';

	// Empty the cart
	if (isset($_POST['empty'])) {
		$cart->clear();
	}

	// Add item
	if (isset($_POST['add'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->add($product->id, $_POST['qty'], [
			'price' => $product->price,
			'color' => (isset($_POST['color'])) ? $_POST['color'] : '',
		]);
	}

	// Update item
	if (isset($_POST['update'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->update($product->id, $_POST['qty'], [
			'price' => $product->price,
			'color' => (isset($_POST['color'])) ? $_POST['color'] : '',
		]);
	}

	// Remove item
	if (isset($_POST['remove'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->remove($product->id, [
			'price' => $product->price,
			'color' => (isset($_POST['color'])) ? $_POST['color'] : '',
		]);
	}

	if (!$cart->isEmpty()) {
		$allItems = $cart->getItems();

		$cartContents = '
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-7">Product</th>
					<th class="col-md-3 text-center">Quantity</th>
					<th class="col-md-2 text-right">Price</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->id) {
						break;
					}
				}

				$cartContents .= '
				<tr>
					<td>' . $product->name . ((isset($item['attributes']['color'])) ? ('<p><strong>Color: </strong>' . $colors[$item['attributes']['color']] . '</p>') : '') . '</td>
					<td class="text-center"><div class="form-group"><input type="number" value="' . $item['quantity'] . '" class="form-control quantity pull-left" style="width:100px"><div class="pull-right"><button class="btn btn-default btn-update" data-id="' . $id . '" data-color="' . ((isset($item['attributes']['color'])) ? $item['attributes']['color'] : '') . '"><i class="fa fa-refresh"></i> Update</button><button class="btn btn-danger btn-remove" data-id="' . $id . '" data-color="' . ((isset($item['attributes']['color'])) ? $item['attributes']['color'] : '') . '"><i class="fa fa-trash"></i></button></div></div></td>
					<td class="text-right">R' . $item['attributes']['price'] . '</td>
				</tr>';
			}
		}

		$cartContents .= '
			</tbody>
		</table>

		<div class="text-right">
			<h3>Total:<br />R' . number_format($cart->getAttributeTotal('price'), 2, '.', ',') . '</h3>
		</div>

		<p>
			<div class="pull-left">
				<button class="btn btn-danger btn-empty-cart">Empty Cart</button>
			</div>
			<div class="pull-right text-right">
				<a href="?a=home" class="btn btn-default">Continue Shopping</a>
				<a href="?a=checkout" class="btn btn-danger">Checkout</a>
			</div>
		</p>';
	}
}
?>
