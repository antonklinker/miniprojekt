<?php
require_once '/home/mir/lib/db.php';
session_start();

$selectedUser = $_GET['user'];

 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>
     <?php
     echo $selectedUser;
      ?></title>
   </head>
   <body>
     <?php
     $pids = get_pids_by_uid($selectedUser);
     foreach ($pids as $pid) {

       $post = get_post($pid);
       echo '<div class="">';
       echo $post['title'];
       echo "<br>";
       echo $post['date'];
       echo "<form class='' action='view_post.php' method='GET'>
       <input type='hidden' name='post_id' value='";
       echo $pid;
       echo "'>
         <input type='submit' name='' value='View post'>
       </form>";
       echo "</div>";
     } ?>
   </body>
 </html>
