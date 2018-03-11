<?php
  require 'dbConnect.php';

  $arr = mysqli_query($db, "SELECT * FROM images") or die(mysqli_error()); // get all images table data

  echo "<form method='POST'>"; // form for deleting
  while($images = mysqli_fetch_assoc($arr))
    {
      echo "<a href='"."images/".$images['image']."'>
            <img src='"."icons/".$images['icon']."'/></a> "; // show icons and kind of popup the big one
      echo "<form method='POST'>
            <button type='submit' name='del' value='".$images['ID']."'>Delete</button>"; // show button and set the name by id
    }
    echo "</form>";

    if (isset($_POST["del"])) // deleting
    {
      $id = $_POST["del"];

      $data = mysqli_query($db, "SELECT * FROM images WHERE ID = $id");
      $data = mysqli_fetch_assoc($data);

      if(unlink("images/".$data['image']) && unlink("icons/".$data['icon'])) // deleting files from server
      {
        if (mysqli_query($db, "DELETE FROM images WHERE ID = $id")) // deleting files from database
          header("Refresh:0; url=2_images.php");
        else
          echo "Error: in database";
      } else
          echo "Error: in server";


    }

    if (isset($_POST["go"]))
    {
      $pic = $_FILES['pic']['tmp_name'];
      $picName = $_FILES['pic']['name'];

      $data = mysqli_query($db, "SELECT image FROM images WHERE image = '$picName'");

      if(!mysqli_num_rows($data)) // if there already is a picture whith that name
      {
        if (is_uploaded_file($pic)) // if a picture was uploaded
        {
           $picUrl = "images/". $picName;

           $icon = $pic;
           $iconName = "icon_". $picName;
           $iconUrl = "icons/". $iconName;

             if(move_uploaded_file($pic, $picUrl)) // if a picture was uploaded on server
             {
               $type = explode(".", $picUrl); // finding out a type (divide by ".")
               $type = $type[count($type)-1]; // take last string

               $size = getimagesize($picUrl);
               $width = $size[0];
               $height = $size[1];

               if($width > $height)
               {
                 $iWidth = 100;
                 $iHeight = 100 * $height / $width;
               } else {
                 $iWidth = 100 * $width / $height;
                 $iHeight = 100;
               }

               $trueIcon = imagecreatetruecolor($iWidth, $iHeight); // make black square

               switch($type)
               {
                   case 'gif':
                     imagecopyresampled($trueIcon, imagecreatefromgif($picUrl),
                                        0, 0, 0, 0, $iWidth, $iHeight, $width, $height);
                     imagegif($trueIcon, $iconUrl);
                   break;

                   case 'jpg':
                     imagecopyresampled($trueIcon, imagecreatefromjpeg($picUrl),
                                        0, 0, 0, 0, $iWidth, $iHeight, $width, $height);
                     imagejpeg($trueIcon, $iconUrl);
                   break;

                   case 'png':
                     imagecopyresampled($trueIcon, imagecreatefrompng($picUrl),
                                        0, 0, 0, 0, $iWidth, $iHeight, $width, $height);
                     imagepng($trueIcon, $iconUrl);
                   break;
               }

               if (file_exists($iconUrl))
               {
                 $query = mysqli_query($db, "INSERT INTO images (image, icon) VALUES
                                      ('$picName', '$iconName')"); // put url in database
                 echo "<a href='$picUrl'><img src='$iconUrl'/></a>"; // show uploaded picture
               }
             }

      		 else
      				echo 'Error: moving file failed';

      	} else
      		echo "Error: empty file";
      } else
          echo "Error: image with such name is already exist";
    }
?>
