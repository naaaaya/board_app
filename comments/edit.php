<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Edit Comment</title>
</head>
<body>
  <div class='wrapper'>
    <p>Edit Comment</p>
    <?php
    $stmt = $db->prepare('select * from comments where id = :comment_id');
    $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $comment_id = h($_GET['comment_id']);
    $thread_id = h($_GET['thread_id']);
    $stmt->execute();
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<form action = 'update.php?comment_id=" . $comment_id . "&thread_id=" . $thread_id . "' method='post' accept-charset='utf-8'>";
    echo "<textarea name='content' rows='4' cols='40'>" . $comment['content'] . "</textarea>";
    ?>
    <input type="submit" value="Edit" class = "edit_btn">
  </form>
</div>
</body>