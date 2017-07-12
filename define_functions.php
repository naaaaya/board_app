<?php

function define_db_constants(){
  define('DB_DATABASE', 'board_app');
  define('DB_USERNAME', 'dbuser');
  define('DB_PASSWORD', 'saayiataon');
  define('PDO_DSN', 'mysql:host=localhost;dbname=' . DB_DATABASE);

  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
}

function set_current_user(){
  session_start();
  $current_user = $_SESSION['current_user'];
  return $current_user;
}

function user_signed_in(){
  session_start();
  if (!$_SESSION['current_user']){
    header("Location:/board_app/users/sessions/new.php");
  }
}

function h($keyword){
 return htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
}