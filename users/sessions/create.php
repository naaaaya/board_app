<?php
if (session_id() !== $_POST['token']) {
  die('正規の画面からご使用ください');
}

require_once "../../define_functions.php";
$db = define_db_constants();

try {
  $stmt = $db->prepare("select * from users where email = :email and password = :password");
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':password', $password, PDO::PARAM_STR);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = h($_POST['email']);
    $password = h($_POST['password']);
    $stmt->execute();
  }

  if ($email === "" || $password === ""){
    echo "Email or Password can't be blank.";
  } else {
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user){
      session_start();
      $_SESSION['current_user'] = $user;
      header("Location:../../threads/index.php");
    } else {
      header('Location:../registrations/new.php');
    }
  }
  $db = null;

} catch (PDOException $e) {
  echo 'ログインに失敗しました。';
  echo "<a href='new.php'>Back</a>";
  exit;
}
?>