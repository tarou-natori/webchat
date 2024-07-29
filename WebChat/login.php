<?php
session_start();
$error_message = isset($_SESSION['login_error_message']) ? $_SESSION['login_error_message'] : "";
unset($_SESSION['login_error_message']);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>ログイン画面</title>
</head>
<body>
  <div class="container">
    <h1>ログイン</h1>
    <?php if(isset($error_message)): ?>
        <p class="caution"><?php echo $error_message; ?></p>
    <?php endif ?>
    <form action="login_check.php" method="post">
      <label for="email">メールアドレス：</label>
      <input type="email" name="email" placeholder="例）sample@xxx.com" required>
      <label for="pass">パスワード：</label>
      <input type="password" name="pass" placeholder="パスワードを入力して下さい">
      <button type="submit">ログイン</button>
    </form>
    <div class="center_position">
      <p>アカウントをお持ちでない方は<a href="register.php">新規登録ページ</a>へ</p>
    </div>
  </div>
</body>
</html>