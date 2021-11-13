<?php
require_once '/home/mir/lib/db.php';
session_start();
$post = get_post($_GET['post_id']);
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <form class="" action="edit_post.php" method="post">
       <label for="">New title</label>
       <input type="text" name="edited_title" value=
       <?php
       echo $post['title'];
        ?>
        >
       <label for="">New content</label>
       <input type="text" name="edited_content" value=
       <?php
       echo $post['content'];
        ?>
        >
        <input type="hidden" name="post_id" value=
        <?php
        echo $_GET['post_id'];
         ?>
         >
        <input type="submit" name="" value="Submit changes">
     </form>

   </body>
 </html>
