<?php
session_start();
require_once('xss.php');
require_once('dbmanager.php');

$user_name = h($_POST['name']);
$email = h($_POST['email']);
$pass = h($_POST['pass']);
$confirm_pass = h($_POST['confirm_pass']);

$dbm = new DBmanager();

//①パスワードが一致しなかった場合は'error_message'セット
if ($pass !== $confirm_pass){
  $_SESSION['error_message'] = "パスワードが一致しません。";
}

// ②同じユーザー名が存在した場合は'error_name_message'セット
if ($dbm->isUserNameExists($user_name)) {
  $_SESSION['error_name_message'] = "同じ名前のユーザー名が既に存在します。";
}

//③同じメールアドレスが存在した場合は'error_email_message'セット
if ($dbm->isUserEmailExists($email)) {
  $_SESSION['error_email_message'] = "同じメールアドレスが既に登録されています。";
}

//①②③のどれかに該当した場合は'register.php'にリダイレクト
if ($pass !== $confirm_pass || $dbm->isUserNameExists($user_name) || $dbm->isUserEmailExists($email)) {
  header("Location: register.php");
  exit;
}

// ①,②,③のどれにも該当しなかったら`confirm.php`に遷移
if($pass === $confirm_pass && $dbm->isUserNameExists($user_name) == false && $dbm->isUserEmailExists($email) == false){
  $_SESSION['name'] = $user_name;
  $_SESSION['email'] = $email;
  $_SESSION['pass'] = $pass;
  header('Location: confirm.php');
  exit;
}
?>