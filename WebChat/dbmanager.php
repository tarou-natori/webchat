<?php
  class DBmanager
  {
    private $access_info;
    private $user;
    private $password;
    private $db = null;
    function __construct()
    {
      $this->access_info = "mysql:host=localhost;dbname=webchat";
      $this->user = "root";
      $this->password = "root";
    }

    private function connect()
    {
      $this->db = new PDO($this->access_info,$this->user,$this->password);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function disconnect()
    {
      $this->db = null;
    }

    //ユーザー情報の挿入
    function insert_user($user_name, $email, $password, $created_at)
    {
      try {
        $this->connect();
        $stmt = $this->db->prepare("INSERT INTO users (user_name,email,password, created_at) VALUES (:user_name,:email,:password, :created_at)");
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
        $result = $stmt->execute();
        $this->disconnect();
        return $result;
      } catch (PDOException $e) {
        $this->disconnect();
        echo "挿入失敗：" .$e->getMessage();
        return false;
      }
    }

    //特定のユーザー情報の取得(emailによる取得)
    function getUserInfoByEmail($email)
    {
      try {
        $this->connect();
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $result = $stmt->execute();
        if ($result) {
          $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $user;
        }
      } catch (PDOException $e) {
        $this->disconnect();
        echo "取得失敗：".$e->getMessage();
        return false;
      }
      $this->disconnect();
      return false;
    }

    //特定のユーザー情報の取得（user_nameによる取得）
    function getUserInfoByName($user_name)
    {
      try {
        $this->connect();
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $result = $stmt->execute();
        if ($result) {
          $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $user;
        }
      } catch (PDOException $e) {
        $this->disconnect();
        echo "取得失敗：".$e->getMessage();
        return false;
      }
      $this->disconnect();
      return false;
    }

    //特定のユーザー名がDBにあるか検索
    function isUserNameExists($user_name)
    {
      $this->connect();
      $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE user_name = :user_name");
      $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchColumn() > 0;
    }

    //特定のメールアドレスがDBにあるか検索
    function isUserEmailExists($email)
    {
      $this->connect();
      $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetchColumn() > 0;
    }
    
  }
?>