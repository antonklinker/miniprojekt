<?php
require_once '/home/mir/lib/db.php';
session_start();

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>
     <?php
     echo $_SESSION['user'];
      ?></title>
   </head>
   <body>
     <?php
     $uids = get_uids();
     foreach ($uids as $uid) {
       $user = get_user($uid);
       echo '<a href="user_posts.php?user=';
       echo $user['uid'];
       echo '">';
       echo $user['uid'];
       echo '</a><br>';
     } ?>

   </body>
 </html>
