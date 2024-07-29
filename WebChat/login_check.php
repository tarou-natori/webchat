<?php
session_start();
require('xss.php');
require_once('dbmanager.php');

$dbm = new DBmanager();

//フォームからの入力を取得
$email = h($_POST['email']);
$password = h($_POST['pass']);

//入力されたメールアドレスをもとにパスワード取得→入力されたパスワードと一致するか判定
$user = $dbm->getUserInfoByEmail($email);
if($user) {
    echo $user['password'];
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_name'] = $user['user_name'];
        header("Location: success.php");
        exit;
    } else {
        $_SESSION['login_error_message'] = "パスワードが違います";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['login_error_message'] = "メールアドレスが違います";
    header("Location: login.php");
    exit;
}

?>