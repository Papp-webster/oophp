<?php

include_once 'cors.php';
include_once 'controller/UserController.php';


// Create object of users class
$users = new userController();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// get id from url
$id = intval($_GET['id'] ?? '');

/*$token = $users->generateToken();

foreach($token as $result) {
    echo $result;
}*/

// Get all or a single users from database

if ($api == 'GET') {
	if ($id != 0) {
		$data = $users->allData($id);
	} else {
		$data = $users->allData();
	}
	echo json_encode($data);
}

/* Search users
if ($api == 'GET') {
	$name = $users->test_input($_GET['name']);
	$data = $users->search($name);
	if (!$data) {
		echo $users->message('Nothing found!');
	} else {
		echo json_encode($data);
	}
	
	
}*/

// Add a new users into database
if ($api == 'POST') {
	$name = $users->test_input($_POST['name']);
	$description = $users->test_input($_POST['description']);
	$price = $users->test_input($_POST['price']);

	if ($users->insert($name, $description, $price)) {
		echo $users->message('user added successfully!');
	} else {
		echo $users->message('Failed to add a user!');
	}
}

// Update an users in database
if ($api == 'PUT') {
	parse_str(file_get_contents('php://input'), $post_input);

	$name = $users->test_input($post_input['name']);
	$description = $users->test_input($post_input['description']);
	$price = $users->test_input($post_input['price']);

	if ($id != null) {
		if ($users->update($name, $description, $price, $id)) {
			echo $users->message('user updated successfully!');
		} else {
			echo $users->message('Failed to update a user!');
		}
	} else {
		echo $users->message('user not found!');
	}
}

// Delete an users from database
if ($api == 'DELETE') {
	if ($id != null) {
		if ($users->delete($id)) {
			echo $users->message('user deleted successfully!');
		} else {
			echo $users->message('Failed to delete a user!');
		}
	} else {
		echo $users->message('users not found!');
	}
}