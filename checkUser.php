<?php
  require 'dbConnect.php';

	if(isset($_POST['go']))
  {
		$username = $_POST['username'];
		$password =  $_POST['password'];

		if(!empty($password))
    {
      $query = mysqli_query($db, "SELECT password FROM users WHERE username = '$username'") or die(mysqli_error());
      $data = mysqli_fetch_assoc($query); // making an array to appeal by name

      if($data['password'] === $password) // if the passwords really match 
        header("Refresh:0; url=2_images.php"); // go to the second page
      else
			echo "Wrong username or password";
	  }
	}
?>
