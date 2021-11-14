<?php
require_once '/home/mir/lib/db.php';
session_start();

add_comment($_SESSION['user'], $_POST['new_comment_pid'], $_POST['new_comment_content']);

// refers the user back to the page they came from (either homepage or view_post)
echo "<script>
             window.history.go(-1);
     </script>";
exit;

 ?>
