<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
  
  $account = $_POST["account"]; 
  $email = $_POST["email"];
  $show_method = $_POST["show_method"]; 
  
  $sCharset = 'big5';
  $travel_email = 'travelhunt102@gmail.com';

  $link = create_connection();

  //檢查查詢的帳號是否存在
  $sql = "SELECT developer_fname, developer_lname, developer_password FROM developer WHERE 
          developer_account = '$account' AND developer_email = '$email'";
  $result = execute_sql($link, "travel_db", $sql);

  //如果帳號不存在
  if (mysqli_num_rows($result) == 0)
  {
    //顯示訊息告知使用者，查詢的帳號並不存在
    echo "<script type='text/javascript'>
            alert('您所查詢的資料不存在，請檢查是否輸入錯誤。');
            history.back();
          </script>";
  }
  else  //如果帳號存在
  {
    $row = mysqli_fetch_object($result);
    $fname = $row->developer_fname;
    $lname = $row->developer_lname;
    $password = $row->developer_password;
    $message = "
      <!doctype html>
      <html>
        <head>
          <title></title>
          <meta charset='utf-8'>
        </head>
        <body>
            <p align='center'>
                $fname$lname 您好，您的帳號資料如下：<br><br>
          　　    帳號：$account<br>
          　　    密碼：$password<br><br>
                <a href='http://localhost/travel_web/index.htm'>按此登入本站</a>
            </p>
          </body>
      </html>
    ";

    if ($show_method == "網頁顯示")
    {
      echo $message;   //顯示訊息告知使用者帳號密碼
    }
    else
    {
      /*$subject = "the subject";
      $headers  = "MIME-Version: 1.0\r\n" .
            "Content-type: text/html; charset=$sCharset\r\n" .
            "From: $travel_email\r\n";
      mail($email, $subject, $message, $headers);*/
      
      //顯示訊息告知帳號密碼已寄至其電子郵件了
      echo "<p align='center'>
                $fname$lname 您好，您的帳號資料已經寄至 $email<br><br>
                <a href='index.htm'>按此登入本站</a>
            </p>";
    }
  }
  mysqli_free_result($result);

  mysqli_close($link);
?>