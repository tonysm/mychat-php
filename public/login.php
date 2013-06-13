<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login do chat</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="css/app.css"> -->
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="hero-unit">
					<h1>Welcome to MyChat</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span4 offset4">
				<div class="well">
					<legend>Sign in to MyChat</legend>
					<form method="POST" action="index.php" accept-charset="UTF-8">
						<!-- <label for="department">Department</label> -->
						<input class="span3" placeholder="Department" type="text" name="user[department]" required>
						<!-- <label for="username">Username</label> -->
						<input class="span3" placeholder="Username" type="text" name="user[username]" required> 
						<button class="btn btn-primary" type="submit">Login</button>      
					</form>    
				</div>
			</div>
		</div>
	</div>

	<script src="\\code.jquery.com/jquery.min.js"></script>
	<!-- <script src="js/app.js"></script> -->
</body>
</html>