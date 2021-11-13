<?php
require_once '/home/mir/lib/db.php';
session_start();

modify_post($_POST['post_id'], $_POST['edited_title'], $_POST['edited_content']);

header('Location:homepage.php');
exit;

 ?>
