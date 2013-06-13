<?php
session_start();

header('Content-Type:application/json');
if (isset($_SESSION['user'])) {
	$data = array(
		'username' => $_SESSION['user']['username'],
		'department' => $_SESSION['user']['department']
	);
	echo json_encode($data);
}
exit;