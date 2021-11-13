<?php
  require_once '/home/mir/lib/db.php';
  session_start();

  // IF YOU TRY TO ACCESS THIS PAGE WITHOUT BEING LOGGED IN, YOU WILL BE TRANSFERED TO login.php
  /*if (empty($_SESSION['user'])) {
    header('Location:login.php');
    exit;
  }*/
  // GETS ALL INFO ABOUT THE LOGGED IN USER
  $userinfo = get_user($_SESSION['user']);

  $pids = get_pids();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Welcome

<?php
echo $userinfo['uid'];
?>

</h1>
    <h2>New post</h2>
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
        <input type="file" name="new_post_image" value="" accept="image/*">
      </div>
      <input type="submit" value="Create post">
    </form>

<?php
  foreach($pids as $pid) {
    $post = get_post($pid);
    echo $post['uid'];
    echo "<br>";
    echo $post['title'];
    echo "<br>";
    echo $post['content'];
    echo "<br>";

    if ($post['uid'] == $_SESSION['user']) {
      echo "<form class='' action='view_post.php' method='GET'>
      <input type='hidden' name='post_id' value='";
      echo $pid;
      echo "'>
        <input type='submit' name='' value='Edit post'>
      </form>";
    }

    $cids = get_cids_by_pid($pid);
    foreach($cids as $cid) {
      $comment = get_comment($cid);
      echo $comment['uid'];
      echo "<br>";
      echo $comment['content'];
      echo "<br>";
    }

    echo "<form class='' action='create_comment.php' method='POST'>
      <label for=''>Add comment</label>
      <input type='text' name='new_comment_content' value=''>
      <input type='hidden' name='new_comment_pid' value='";
      echo $pid;
      echo "'>
      <input type='submit' name='' value='Submit'>
    </form>";
  }
 ?>


    <form method='POST' action='logout.php'>
      <input class='' type='submit' value='Logout'>
    </form>
  </body>
</html>
