<?php

include_once 'cors.php';

include_once 'controller/ProductController.php';

// Create object of products class
$products = new ProductController();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// get id from url
$id = intval($_GET['id'] ?? '');




// Get all or a single products from database
if ($api == 'GET') {
	if ($id != 0) {
		$data = $products->fetch($id);
	} else {
		$data = $products->fetch();
	}
	echo json_encode($data);
}

/* Search products
if ($api == 'GET') {
	$name = $products->test_input($_GET['name']);
	$data = $products->search($name);
	if (!$data) {
		echo $products->message('Nothing found!');
	} else {
		echo json_encode($data);
	}
	
	
}*/

// Add a new products into database
if ($api == 'POST') {
	$name = $products->test_input($_POST['name']);
	$description = $products->test_input($_POST['description']);
	$price = $products->test_input($_POST['price']);

	if ($products->insert($name, $description, $price)) {
		echo $products->message('product added successfully!');
	} else {
		echo $products->message('Failed to add a product!');
	}
}

// Update an products in database
if ($api == 'PUT') {
	parse_str(file_get_contents('php://input'), $post_input);

	$name = $products->test_input($post_input['name']);
	$description = $products->test_input($post_input['description']);
	$price = $products->test_input($post_input['price']);

	if ($id != null) {
		if ($products->update($name, $description, $price, $id)) {
			echo $products->message('product updated successfully!');
		} else {
			echo $products->message('Failed to update a product!');
		}
	} else {
		echo $products->message('product not found!');
	}
}

// Delete an products from database
if ($api == 'DELETE') {
	if ($id != null) {
		if ($products->delete($id)) {
			echo $products->message('product deleted successfully!');
		} else {
			echo $products->message('Failed to delete a product!');
		}
	} else {
		echo $products->message('products not found!');
	}
}