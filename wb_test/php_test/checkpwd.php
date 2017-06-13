<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
  
  //帳號
  $account = $_POST["account"];
  $password = $_POST["password"];

  //建立連結
  $link = create_connection();
  mysqli_query($link,'set names utf8');
                    
  //檢查帳號密碼是否正確
  $sql = "SELECT * FROM user WHERE user_account = '$account' AND user_password = '$password'";
  $result = execute_sql($link, "ebizlearn_th", $sql);

  //如果帳號密碼錯誤
  if (mysqli_num_rows($result) == 0)
  {
    mysqli_free_result($result);

    mysqli_close($link);

    echo"<script type='text/javascript'>
           alert('帳號密碼錯誤，請查明後再登入');
           history.back();
        </script>";
  }

  //如果帳號密碼正確
  else
  {
	//傳ID跟開發者帳號
    $id = mysqli_fetch_object($result)->user_id;
    $account = mysqli_fetch_object($result)->user_account;

    mysqli_free_result($result);

    mysqli_close($link);

    //將使用者資料加入 cookies
	setcookie("user_id", $id);
    setcookie("passed", "TRUE");
    header("location:main.php");
  }
?>