<?php
  session_start();
  require_once('xss.php');

  $pass = $_SESSION['pass'];
  $passMask = str_repeat('*', strlen($pass)-1);
  $passLastWord = substr($pass,-1);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>確認画面</title>
</head>
<body>
  <div class="container">
    <h1>確認画面</h1>
    <table>
      <tbody>
        <tr>
          <th>ユーザー名</th>
          <td><?php echo $_SESSION['name']; ?></td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td><?php echo $_SESSION['email']; ?></td>
        </tr>
        <tr>
          <th>パスワード</th>
          <td><?php echo $passMask . $passLastWord; ?></td>
        </tr>
      </tbody>
    </table>
    <form action="complete.php" method="post">
      <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
      <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
      <input type="hidden" name="pass" value="<?php echo $_SESSION['pass']; ?>">
      <button type="submit">登録</button>
      <button type="button" onclick="history.back()">戻る</button>
    </form>
  </div>
</body>
</html>