<?php

require_once '../../define_functions.php';
$db = define_db_constants();
try {
  $stmt = $db->prepare("insert into users (name, email, password) values (:name, :email, :password)");
  $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':password', $password, PDO::PARAM_STR);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = h($_POST['name']);
    $email = h($_POST['email']);
    $password = h($_POST['password']);
    if ($email === "" || $password === ""){
      echo "Email or Password can't be blank.";
    } else {
      $stmt->execute();
      header("Location:../../threads/index.php");
    }
  }
} catch (PDOException $e) {
  echo "登録に失敗しました。";
  echo "<a href='new.php'>Back</a>";
  exit;
}
?>