<?php
require_once('xss.php');
require_once('dbmanager.php');

$user_name = h($_POST['name']);
$email = h($_POST['email']);
$password = password_hash(h($_POST['pass']), PASSWORD_DEFAULT);
date_default_timezone_set('Asia/Tokyo');
$created_at = date("Y/m/d H:i:s");

$dbm = new DBmanager();

$result = $dbm->insert_user($user_name, $email, $password, $created_at);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>完了画面</title>
</head>
<body>
  <?php if($result): ?>
  <div class="container">
    <h1>登録完了</h1>
    <div class="center_position">
      <p>登録が完了いたしました</p>
      <p><a href="login.php">ログインページ</a>へ</p>
    </div>
  </div>
  <?php else: ?>
    <div class="container">
      <h1>登録失敗</h1>
      <div class="center_position">
        <p>登録が失敗いたしました</p>
        <p>お手数ですがもう一度やり直して下さい</p>
        <p><a href="register.php">新規登録ページ</a>へ</p>
      </div>
    </div>
  <?php endif; ?>
</body>
</html>