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
    <p>Sign up</p>
    <form action = "create.php" method="post" accept-charset="utf-8">
      Name : <input type="text" name="name">
      Email : <input type="text" name="email">
      Password : <input type="text" name="password">
      <input type="submit" value="Sign up" class = "create_btn">
    </form>
  </div>
  <a href='../sessions/new.php'>Sign in</a>
</body>