<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();
$thread_id = h($_GET['id']);

try{
  $db->beginTransaction();
  $stmt = $db->prepare('delete from comments where thread_id = :thread_id');
  $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
  $stmt->execute();

  $stmt = $db->prepare('delete from threads where id = :thread_id');
  $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
  $stmt->execute();
  $db->commit();

  header('Location:index.php');
} catch (Exception $e) {
  $db->rollBack();
  echo "削除に失敗しました。";
  echo "<a href='index.php'>Back</a>";
}
