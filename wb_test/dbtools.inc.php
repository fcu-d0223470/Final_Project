<?php
  function create_connection()
  {
    $localhost="140.134.27.141";
    $root="ebizlearn_th";
    $mypassword="P@ssw0rd";
    $database="ebizlearn_th";   
        
    $link = mysqli_connect($localhost, $root, $mypassword)
      or die("無法建立資料連接: " . mysqli_connect_error());

    mysqli_query($link, "SET NAMES utf8");

    return $link;
  }

  function execute_sql($link, $database, $sql)
  {
    mysqli_select_db($link, $database)
      or die("開啟資料庫失敗: " . mysqli_error($link));

    $result = mysqli_query($link, $sql);

    return $result;
  }
?>