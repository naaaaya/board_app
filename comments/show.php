<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();
$thread_id = h($_GET['id']);
$stmt = $db->prepare('select * from threads where id = :thread_id');
$stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
$stmt->execute();
$thread = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title><?php echo $thread['name']; ?></title>
</head>
<body>
  <div class='wrapper'>
    <h3><?php echo $thread['name']; ?></h3>
    <p><?php echo $thread['description']; ?></p>
    <ul class='threads_list'>
      <?php
      try {
        $stmt = $db->prepare("select * from comments where thread_id = :thread_id");
        $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$comments){
          echo 'No Comment';
        }
        foreach($comments as $comment){
          echo "<li>" . $comment['content'] . "</li>";
          session_start();
          if ($comment['user_id'] === $current_user['id']){
            echo "<a href = 'edit.php?comment_id=" . $comment['id'] . "&thread_id=" . $thread_id . "'>Edit</a>\n<a href= 'delete.php?comment_id=" . $comment['id'] . "&thread_id=" . $thread_id . "'>Delete</a>";
          };
        }

      } catch (PDOException $e) {
        echo "表示に失敗しました。";
        echo "<a href='show.php'>Retry</a>";
        exit;
      }
      ?>
    </ul>
    <div class="send_comment">
      <?php echo "<form action = 'create.php?id=" . $thread_id . "' method='post' accept-charset='utf-8'>" ?>
      <input type="text" name="content">
      <input type="submit" value="Send" class = "send_btn">
    </form>
  </div>
  <a href='../threads/index.php'>Back</a>
</div>
</body>