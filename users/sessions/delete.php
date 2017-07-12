<?php
try{
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}
session_destroy();
header('Location:../../threads/index.php');
} catch(PDOException $e) {
  echo "ログアウトに失敗しました。";
  echo "<a href='../threads/index.php'>Back</a>";
  exit();
}
?>