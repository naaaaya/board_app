<?php
try{
  require_once '../define_functions.php';
  user_signed_in();
  $db = define_db_constants();
  $current_user = set_current_user();
  $stmt = $db->prepare("delete from comments where id = :comment_id");
  $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
  $comment_id = h($_GET['comment_id']);
  $thread_id = h($_GET['thread_id']);
  $stmt->execute();
  header("Location:show.php?id=" . $thread_id);
} catch (PDOException $e) {
  echo '削除に失敗しました。';
  echo "<a href=show.php?id=" . $thread_id . ">Back</a>";
}