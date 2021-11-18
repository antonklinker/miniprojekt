<?php
require_once '/home/mir/lib/db.php';
session_start();

// using htmlentities to avoid injections
add_comment($_SESSION['user'], $_POST['new_comment_pid'], htmlentities($_POST['new_comment_content']));

// refers the user back to the page they came from (either homepage or view_post)
echo "<script>
             window.history.go(-1);
     </script>";
exit;

 ?>
