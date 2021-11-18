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
    if (add_user(htmlentities($_POST['newusrname']), htmlentities($_POST['fname']), htmlentities($_POST['lname']), htmlentities($_POST['newpasswrd']))) {
      header('Location:signup.php');
      exit;
    }
}

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
      <form method='POST' action=''>
        <h2 style="text-align: center">Existing user</h2>
        <div class='form-group'>
          <label for='newusr'>Username:</label>
          <input class='form-control' type='text' class='' name='username'>
        </div>
        <div class='form-group'>
          <label for='newpsw'>Password:</label>
          <input class='form-control' type='password' class='' name='password'>
        </div>
        <br>
        <input class='btn btn-primary' type='submit' value='Login'>
      </form>

      <br>
      <br>
      <br>

      <form method='POST' action=''>
        <h2 style="text-align: center">New user</h2>
        <div class='form-group'>
          <label for='usr'>First name:</label>
          <input class='form-control' type='text' class='' name='fname'>
        </div>
        <div class='form-group'>
          <label for='usr'>Last name:</label>
          <input class='form-control' type='text' class='' name='lname'>
        </div>
        <div class='form-group'>
          <label for='newusername'>New username:</label>
          <input class='form-control' type='text' class='' = name='newusrname'>
        </div>
        <div class='form-group'>
          <label for='newpasswrd'>New password:</label>
          <input class='form-control' type='password' class='' = name='newpasswrd' autocomplete="new-password">
        </div>
        <br>
        <input class='btn btn-success' type='submit' value='Signup' style='width: 100%'>
      </form>
      <br>
    </div>
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
