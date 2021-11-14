<?php
require_once '/home/mir/lib/db.php';
session_start();

modify_post($_POST['post_id'], $_POST['edited_title'], $_POST['edited_content']);

// refers the user back to the page they came from (either homepage or view_post)
echo "<script>
             window.history.go(-1);
     </script>";
exit;

 ?>
