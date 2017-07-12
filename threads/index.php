<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Sign up</title>
</head>
<body>
  <div class='wrapper'>
    <p>Threads</p>
    <ul class='nav-var'>
      <li><a href='new.php'>Create New Thread</a></li>
      <?php
      if ($current_user){
        echo "<li><a href='../users/sessions/delete.php?id=" . $current_user['id'] . " '>Sign out </a></li>";
      } else {
        echo "<li><a href='../users/registrations/new.php'>Sign up</a></li>";
        echo "<li><a href='../users/sessions/new.php'>Sign in</a></li>";
      }
      ?>
    </ul>
    <ul class='threads_list'>
      <?php
      try {
        $stmt = $db->query('select * from threads');
        $threads = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($threads as $thread){
          echo "<li><a href='../comments/show.php?id=". $thread['id'] . "'>" . $thread['name'] . "</li>";
          if ($thread['user_id'] === $current_user['id']){
            echo "<a href = 'edit.php?id=" . $thread['id'] . "'>Edit</a>\n<a href= 'delete.php?id=" . $thread['id'] . "'>Delete</a>";
          };
        }

      } catch (PDOException $e) {
        echo "表示に失敗しました。";
        echo "<a href= 'index.php'>Retry</a>";
        exit;
      }
      ?>
    </ul>
  </div>
</body>