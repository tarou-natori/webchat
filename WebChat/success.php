<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header("Location: login.php");
  exit;
}

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>ようこそ、<?php  echo $_SESSION['user_name']. 'さん'; ?></p>
  <a href="logout.php">ログアウト</a>
</body>
</html>