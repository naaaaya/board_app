<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();

try{
  $stmt = $db->prepare('update comments set content = :content where id = :comment_id');
  $stmt->bindParam(':content', $content, PDO::PARAM_STR);
  $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
  $comment_id = h($_GET['comment_id']);
  $thread_id = h($_GET['thread_id']);
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = h($_POST['content']);
    $stmt->execute();
    header("Location:show.php?id=" . $thread_id);
  }
} catch (PDOException $e) {
  echo '編集に失敗しました。';
  echo "<a href= 'edit.php?comment_id=" . $comment_id . "& thread_id=" . $thread_id . "'>Back</a>";
}