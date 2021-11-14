<?php
require_once '/home/mir/lib/db.php';
session_start();

delete_comment($_POST['comment_id']);

// refers the user back to the page they came from (either homepage or view_post)
echo "<script>
             window.history.go(-1);
     </script>";
exit;

 ?>
