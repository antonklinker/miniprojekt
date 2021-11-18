<?php
require_once '/home/mir/lib/db.php';
session_start();

$selectedUser = $_GET['user'];

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
     // Checks if you are logged in
     if ($selectedUser!='') {
       echo '<div class="post-preview">';
         echo '<p class="post-meta" style="text-align: center; margin-bottom: 1px;">';
           echo 'all posts made by';
         echo '</p>';
        echo '<h2 class="post-title" style="text-align: center; font-size: 80px">';
          echo $selectedUser;
        echo '</h1>';
      echo "</div>";
      echo "<br>";
      echo "<br>";
     $pids = get_pids_by_uid($selectedUser);

     if (count($pids)==0) {
       echo '<div class="post-preview">';
        echo '<h2 class="post-title" style="text-align: center">';
          echo 'This user has not made any posts yet';
        echo '</h2>';
      echo "</div>";
      echo "<br>";
     }

     foreach ($pids as $pid) {
       $post = get_post($pid);
       echo '<div class="post-preview">';
       echo '<a href="view_post.php?post_id=';
         echo $pid;
         echo '">';
         echo '<h2 class="post-title">';
         echo $post['title'];
         echo '</h2>';
       echo "</a>";

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
       echo "</div>";
       echo '<hr class="my-4" />';
      }
     } else {
       // If you are not logged in
       echo '<div class="post-preview">';
        echo '<h2 class="post-title" style="text-align: center">';
          echo 'You are not logged in';
        echo '</h2>';
      echo "</div>";
      echo "<br>";
     } ?>

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
