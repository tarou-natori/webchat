<?php
session_start();
$error_messages[] = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
$error_messages[] = isset($_SESSION['error_name_message']) ? $_SESSION['error_name_message'] : '';
$error_messages[] = isset($_SESSION['error_email_message']) ? $_SESSION['error_email_message'] : '';
unset($_SESSION['error_message']);
unset($_SESSION['error_name_message']);
unset($_SESSION['error_email_message']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>新規登録画面</title>
</head>
<body>
  <div class="container">
    <h1>新規登録</h1>
    <p class="caution">*は必須項目です</p>
    <?php if (count($error_messages) > 0): ?> 
      <?php foreach($error_messages as $error_message): ?>
        <p class="caution"><?php echo $error_message; ?></p>
      <?php endforeach; ?>
    <?php endif; ?>
    <form action="validation_check.php" method="post">
      <label for="name" class="required">ユーザー名：</label>
      <input type="text" name="name" placeholder="例）山田太郎" required>
      <label for="email" class="required">メールアドレス：</label>
      <input type="email" name="email" placeholder="例）sample@xxx.com" required>
      <label for="pass" class="required">パスワード：</label>
      <input type="password" name="pass" placeholder="パスワードを入力して下さい" required>
      <label for="confirm_pass" class="required">パスワード確認：</label>
      <input type="password" name="confirm_pass" placeholder="もう一度入力して下さい" required>
      <button type="submit">次へ</button>
    </form>
    <div class="center_position">
      <p>既にアカウントをお持ちの方は<a href="login.php">ログインページ</a>へ</p>
    </div>
  </div>
</body>
</html>