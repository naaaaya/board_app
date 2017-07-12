<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();
try{
  $stmt = $db->prepare('update threads set name = :name, description = :description where id = :thread_id');
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':description', $description, PDO::PARAM_STR);
  $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
  $thread_id = h($_GET['id']);
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = h($_POST['name']);
    $description = h($_POST['description']);
    $stmt->execute();
    header('Location:index.php');
  }
} catch(PDOException $e) {
  echo "編集に失敗しました。";
  echo "<a href='edit.php?id=". $thread_id . "'>Back</a>";
}