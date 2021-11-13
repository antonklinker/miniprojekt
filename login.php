<?php
require_once '/home/mir/lib/db.php';
session_start();

$userids = get_uids();

// IF THIS SESSION ALREADY HAS A USERNAME, YOU DONT HAVE TO LOG IN AGAIN
/*if (!empty($_SESSION['user'])) {
  header('Location:homepage.php');
  exit;
}*/

// CHECKS IF USERNAME AND PASSWORD IS SET
// USING POST TO AVOID SAVING THE PASSWORD IN THE URL
if (isset($_POST['username']) && isset($_POST['password'])) {
    // CHECKS IF USERNAME AND PASSWORD IS CORRECT
    if (login($_POST['username'], $_POST['password'])) {
      $_SESSION['user'] = $_POST['username'];
      header('Location:homepage.php');
      exit;
    }
}

if (isset($_POST['fname']) && isset($_POST['lname'])
&& isset($_POST['newusrname']) && isset($_POST['newpasswrd'])) {
    // CHECKS IF USERNAME AND PASSWORD IS CORRECT
    if (add_user($_POST['newusrname'], $_POST['fname'], $_POST['lname'], $_POST['newpasswrd'])) {
      header('Location:signup.php');
      exit;
    }
}

?>

<!doctype html>
<html>
  <head>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
  </head>
  <body>
    <div class=''>
      <form method='POST' action=''>
        <div class=''>
          <label for='newusr'>Username:</label>
          <input type='text' class='' name='username'>
        </div>
        <div class=''>
          <label for='newpsw'>Password:</label>
          <input type='password' class='' name='password'>
        </div>
        <br>
        <input class='' type='submit' value='Login'>
      </form>
    </div>

    <div class=''>
      <form method='POST' action=''>
        <div class=''>
          <label for='usr'>First name:</label>
          <input placeholder="Tobias" type='text' class='' name='fname'>
        </div>
        <div class=''>
          <label for='usr'>Last name:</label>
          <input placeholder="Bohr" type='text' class='' name='lname'>
        </div>
        <div class=''>
          <label for='newusername'>New username:</label>
          <input placeholder="TobiasBohr123" type='text' class='' = name='newusrname'>
        </div>
        <div class=''>
          <label for='newpasswrd'>New password:</label>
          <input placeholder="kastanjehaven34" type='text' class='' = name='newpasswrd'>
        </div>
        <br>
        <input class='' type='submit' value='Signup'>
      </form>
    </div>
  </body>
</html>
