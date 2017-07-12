<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();
$thread_id = h($_GET['id']);
try {
  $stmt = $db->prepare("insert into comments (content, user_id, thread_id) values (:content, :user_id, :thread_id)");
  $stmt->bindParam(':content', $content, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = h($_POST['content']);
    $user_id = $current_user['id'];
    $stmt->execute();
  }

  header("Location:show.php?id=". $thread_id );
} catch (PDOException $e) {
  echo "作成に失敗しました。";
  echo "<a href='show.php?id=". $thread_id . "'>Back</a>";
  exit;
}
?>