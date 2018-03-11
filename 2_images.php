<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
	<title>Images</title>
	</head>
	<body>
    <center>
      <br>
      <h1>Images</h1>
			<?php require 'uploadImage.php'; ?>
	      <form action="2_images.php" enctype="multipart/form-data" method="POST">
					<br><br>
	        	<input type="file" name="pic" accept="image/jpeg,image/png,image/gif"/>
	        <br><br>
						<input type="submit" name="go" value="Upload"/>
			</form>
     </center>
	</body>
</html>
