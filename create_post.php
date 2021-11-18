<?php
require_once '/home/mir/lib/db.php';
session_start();

$new_post = add_post($_SESSION['user'], htmlentities($_POST['new_post_title']), htmlentities($_POST['new_post_content']));

// adds the image selected from the form. The form only accepts images,
// which has nothing to do with this, but comments are easier to read here
$new_image = add_image($_FILES['new_post_image']['tmp_name'], ".png");

// adds the image to the post
add_attachment($new_post, $new_image);

// refers the user back to the page they came from (either homepage or view_post)
echo "<script>
             window.history.go(-1);
     </script>";
exit;

 ?>
