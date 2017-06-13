<?php
  //清除 cookie 內容
  setcookie("user_id", "");
  setcookie("user_account", "");
  setcookie("passed", "");

  //將使用者導回主網頁
  header("location:index.htm");
  exit();
?>