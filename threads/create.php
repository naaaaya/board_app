<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
$current_user = set_current_user();

try{
  $stmt = $db->prepare('insert into threads (name, description, user_id) values (:name, :description, :user_id)');
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':description', $description, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = h($_POST['name']);
    $description = h($_POST['description']);
    session_start();
    $user_id = $current_user['id'];
    if ( $name === "" ){
      echo "スレッド名を入力してください";
    } else {
      $stmt->execute();
      header('Location:index.php');
    }
  }
} catch (PDOException $e){
  echo "作成に失敗しました。";
  echo "<a href='new.php'>Back</a>";
}
?>