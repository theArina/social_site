<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
	<title>Entrance</title>
	</head>
	<body>
		<center>
	    <br>
	    <h1>Gates</h1>
	    <?php require 'checkUser.php'; ?>
	      	<br><br>
				<form action="1_enter.php" method="POST">
						<input type="text" name="username"  placeholder="Enter username" required>
					<br><br>
						<input type="password" name="password"  placeholder="Enter password" required>
					<br><br>
						<button type="submit" name="go">Let me in</button>
				</form>
		</center>
	</body>
</html>
