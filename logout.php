<?php
  session_start();
  // Destroys all session variables
  session_destroy();
  header('Location:login.php');
  exit;
 ?>
