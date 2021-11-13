<?php
  require_once '/home/mir/lib/db.php';
  session_start();

  // IF YOU TRY TO ACCESS THIS PAGE WITHOUT BEING LOGGED IN, YOU WILL BE TRANSFERED TO login.php
  if (empty($_SESSION['user'])) {
    header('Location:login.php');
    exit;
  }
  // GETS ALL INFO ABOUT THE LOGGED IN USER
  $userinfo = get_user($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
echo $userinfo['uid'];
?>
    <h1>New post</h1>
    <form class="" action="create_post.php" method="post" enctype="multipart/form-data">
      <div class=''>
        <label>Title</label>
        <input type="text" name="new_post_title" value="">
      </div>
      <div class=''>
        <label>Content</label>
        <input type='text' name='new_post_content' value="">
      </div>
      <div class=''>
        <label>Image</label>
        <input type="file" name="new_post_image" value="">
      </div>
      <input type="submit" value="Create post">
    </form>
    <form method='POST' action='logout.php'>
      <input class='' type='submit' value='Logout'>
    </form>
  </body>
</html>
