<?php
    $db = mysqli_connect ("localhost", "root", "", "social_db");

    if (!$db) {
    echo "Error: Unable to connect to MySQL" . "<br/>";
    echo "Errno code: " . mysqli_connect_errno()."<br/>";
    echo "Error text: " . mysqli_connect_error()."<br/>";
    exit;
}
?>
