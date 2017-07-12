<?php
require_once '../define_functions.php';
user_signed_in();
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Sign up</title>
  <link rel="stylesheet" type='text/css' href="stylesheets/reset.css">
  <link rel="stylesheet" type='text/css' href="users.css">
</head>
<body>
  <div class='wrapper'>
    <p>Create New Thread</p>
    <form action = "create.php" method="post" accept-charset="utf-8">
      Name : <input type="text" name="name">
      Description : <textarea name="description" rows="4" cols="40"></textarea>
      <input type="submit" value="Create" class = "create_btn">
    </form>
    <a href='../threads/index.php'>Back</a>
  </div>
</body>