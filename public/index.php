<?php
session_start();

if (!isset($_POST['user']) && !isset($_SESSION['user'])) {
	header('location:login.php');
}

if (isset($_POST['user'])) {
	$_SESSION['user'] = $_POST['user'];
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index do chat</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/app.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span10">
				<h2>Welcome to MyChat</h2>
				<div id="chatwindow">
					<div id="messagewindow" class="row well">
					<!-- messages -->
					</div>
					<div id="inputcontainer" class="row">
						<p>
							<input type="text" id="msginput" placeholder="enter your message here">
						</p>
					</div>
				</div>
			</div>
			<div class="span2">
				<h3>online (<span id="chatcount">0</span>)</h3>
				<ul id="userlist">
				</ul>
			</div>
		</div>
	</div>

	<script src="\\code.jquery.com/jquery.min.js"></script>
	<script src="js/app.js"></script>
</body>
</html>