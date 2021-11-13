<?php
  session_start();

  // SETS THE SESSION VARIABLE TO '' AND SENDS YOU BACK TO LOGIN
  $_SESSION['user'] = '';
  header('Location:login.php');
  exit;
 ?>
