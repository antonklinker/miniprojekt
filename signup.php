<?php
require_once '/home/mir/lib/db.php';

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
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <h1>Congratulations! Login with your new user here</h1>
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
   </body>
 </html>
