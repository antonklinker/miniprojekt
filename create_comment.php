<?php
require_once '/home/mir/lib/db.php';
session_start();

add_comment($_SESSION['user'], $_POST['new_comment_pid'], $_POST['new_comment_content']);

header('Location:homepage.php');
exit;

 ?>
