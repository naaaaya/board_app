<?php
require_once '../define_functions.php';
user_signed_in();
$db = define_db_constants();
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Edit Thread</title>
</head>
<body>
  <div class='wrapper'>
    <p>Edit Thread</p>
    <?php
    $stmt = $db->prepare('select * from threads where id = :thread_id');
    $stmt->bindParam(':thread_id', $thread_id, PDO::PARAM_INT);
    $thread_id = h($_GET['id']);
    $stmt->execute();
    $thread = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<form action = 'update.php?id=" . $thread_id . "' method='post' accept-charset='utf-8'>";
    echo "Name : <input type='text' name='name' value= " . $thread['name']. ">";
    echo "Description : <textarea name='description' rows='4' cols='40'>" . $thread['description'] . "</textarea>";
    ?>
    <input type="submit" value="Edit" class = "edit_btn">
  </form>
</div>
</body>