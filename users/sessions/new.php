<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Sign in</title>
  <link rel="stylesheet" type='text/css' href="stylesheets/reset.css">
  <link rel="stylesheet" type='text/css' href="users.css">
</head>
<body>
<?php
?>
  <div class='wrapper'>
    <p>Sign in</p>
    <form action = "create.php" method="post" accept-charset="utf-8">
      Email : <input type="text" name="email">
      Password : <input type="text" name="password">
      <input type="hidden" name="token" value="<?php echo session_id(); ?>" >
      <input type="submit" value="Sign In" class = "create_btn">
    </form>
  </div>
  <a href='../registrations/new.php'>Sign up</a>
</body>