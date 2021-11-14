<?php
require_once '/home/mir/lib/db.php';
session_start();
$post = get_post($_GET['post_id']);
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />
     <title>Homepage</title>
     <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
     <!-- Font Awesome icons (free version)-->
     <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
     <!-- Google fonts-->
     <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
     <!-- Core theme CSS (includes Bootstrap)-->
     <link href="css/styles.css" rel="stylesheet" />
 </head>
   <body>
     <!-- Navigation-->
     <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
         <div class="container px-4 px-lg-5">
             <a class="navbar-brand" href="homepage.php">Home</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                 Menu
                 <i class="fas fa-bars"></i>
             </button>
             <div class="collapse navbar-collapse" id="navbarResponsive">
                 <ul class="navbar-nav ms-auto py-4 py-lg-0">
                     <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="user_posts.php?user=<?php
                       // Sends you to user_posts.php where you can see all your posts
                       echo $_SESSION['user'];
                       ?>">Profile</a></li>
                     <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="users.php">Friends</a></li>
                     <?php
                     if (!empty($_SESSION['user'])) {
                     echo '<li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="logout.php">Logout</a></li>';
                   } else {
                     echo '<li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="logout.php">Login</a></li>';
                   }
                      ?>
                 </ul>
             </div>
         </div>
     </nav>
     <!-- Page Header-->
     <header class="masthead" style="background-image: url('assets/img/witswallpaper.jpg')">
         <div class="container position-relative px-4 px-lg-5">
             <div class="row gx-4 gx-lg-5 justify-content-center">
                 <div class="col-md-10 col-lg-8 col-xl-7">
                     <div class="site-heading">
                         <h1>Tons Forum</h1>
                         <span class="subheading">a forum by Ton</span>
                     </div>
                 </div>
             </div>
         </div>
     </header>
     <!-- Main Content-->
     <div class="container px-4 px-lg-5">
         <div class="row gx-4 gx-lg-5 justify-content-center">
           <div class="col-md-10 col-lg-8 col-xl-7">
       <?php
         echo '<div class="post-preview">';
             echo '<h2 class="post-title">';
             echo $post['title'];
             echo '</h2>';
             echo '<h3 class="post-subtitle">';
             echo $post['content'];
             echo "</h3>";
           echo "</a>";

       $iids = get_iids_by_pid($post['pid']);
       foreach($iids as $iid) {
         $image = get_image($iid);
         echo '<div class="col-md-10 col-lg-8 col-xl-7">';
         echo '<img class="img-fluid" src="';
         echo $image['path'];
         echo '" alt="">';
         echo '</div>';
       }

       echo '<p class="post-meta">
             Posted by
               <a href="user_posts.php?user=';
               echo $post['uid'];
               echo '">';
               echo $post['uid'];
         echo '</a>
           on ';
           echo $post['date'];
         echo '</p>';

         /*if (!empty($_SESSION['user'])) {
             if ($post['uid'] == $_SESSION['user']) {
               echo "<form class='' action='view_post.php' method='GET'>
               <input type='hidden' name='post_id' value='";
               echo $pid;
               echo "'>
                 <input type='submit' name='' value='Edit post'>
               </form>";
             }
           }*/

         $cids = get_cids_by_pid($pid);
         foreach($cids as $cid) {
           $comment = get_comment($cid);
           echo '<hr class="md-5" />';
           echo $comment['content'];

           echo '<p class="post-meta">
                 Comment by
                   <a href="user_posts.php?user=';
                   echo $comment['uid'];
                   echo '">';
                   echo $comment['uid'];
             echo '</a>
               on ';
               echo $comment['date'];
               if (!empty($_SESSION['user'])) {
                 if ($comment['uid'] == $_SESSION['user'] || $post['uid'] == $_SESSION['user']) {
                   echo "<form class='' action='delete_comment.php' method='POST'>
                   <input type='hidden' name='comment_id' value='";
                   echo $cid;
                   echo "'>
                       <input class='btn btn-danger' type='submit' name='' value='Delete comment'>
                   </form>";
                 }
               }
             echo '</p>';
         }
         if (!empty($_SESSION['user'])) {
           echo "<form class='' action='create_comment.php' method='POST'>
             <div class='form-group'>
               <input class='form-control' type='text' name='new_comment_content' value=''>
               <input type='hidden' name='new_comment_pid' value='";
               echo $pid;
               echo "'>
             </div>
             <br>
             <input class='btn btn-secondary' type='submit' name='' value='Add comment'>
           </form>";
         }
         echo '<hr class="my-4" />';
         echo "</div>";
         echo "<br>";
         echo "<br>";
      ?>


       <?php
       // checks if the logged in user has written the post (ignores case sensitivity)
       // if the logged in user has written the post then the user is allowed to modify the post
       if (strcasecmp($post['uid'], $_SESSION['user']) == 0) {

         echo '
     <form class="" action="edit_post.php" method="post">
      <div class="form-group">
         <label for="">New title</label>
         <input class="form-control" type="text" name="edited_title" value="">
      </div>
      <div class="form-group">
        <label for="">New content</label>
        <input class="form-control" type="text" name="edited_content" value="">
      </div>
        <input type="hidden" name="post_id" value=';
        echo $_GET['post_id'];
         echo '>
         <br>
        <input class="btn btn-primary" type="submit" name="" value="Submit changes">
     </form>';

     } ?>
    <br>
   </div>
 </div>
</div>

   <!-- Footer-->
   <footer class="border-top">
       <div class="container px-4 px-lg-5">
           <div class="row gx-4 gx-lg-5 justify-content-center">
               <div class="col-md-10 col-lg-8 col-xl-7">
                   <ul class="list-inline text-center">
                       <li class="list-inline-item">
                         <a href="https://www.twitter.com">
                             <span class="fa-stack fa-lg">
                                 <i class="fas fa-circle fa-stack-2x"></i>
                                 <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                             </span>
                         </a>
                     </li>
                     <li class="list-inline-item">
                         <a href="https://www.facebook.com">
                             <span class="fa-stack fa-lg">
                                 <i class="fas fa-circle fa-stack-2x"></i>
                                 <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                             </span>
                         </a>
                     </li>
                     <li class="list-inline-item">
                         <a href="https://www.github.com">
                             <span class="fa-stack fa-lg">
                                 <i class="fas fa-circle fa-stack-2x"></i>
                                 <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                             </span>
                         </a>
                       </li>
                   </ul>
                   <div class="small text-center text-muted fst-italic">Copyright &copy; Tons Forum 2021</div>
               </div>
           </div>
       </div>
   </footer>
 </body>
</html>
