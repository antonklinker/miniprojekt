<?php
require_once '/home/mir/lib/db.php';
session_start();

$new_post = add_post($_SESSION['user'], $_POST['new_post_title'], $_POST['new_post_content']);

$new_image = add_image($_FILES['new_post_image']['tmp_name'], ".png");

add_attachment($new_post, $new_image);

// refers the user back to the page they came from (either homepage or view_post)
echo "<script>
             window.history.go(-1);
     </script>";
exit;

 ?>
