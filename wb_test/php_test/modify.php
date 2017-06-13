<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE{"passed"};

  //如果 cookie 中的 passed 變數不等於 TRUE
  //表示尚未登入網站，將使用者導向首頁 index.htm
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }

  //如果 cookie 中的 passed 變數等於 TRUE
  //表示已經登入網站，取得使用者資料
  else
  {
    require_once("dbtools.inc.php");

    $user_id = $_COOKIE{"user_id"};

    $link = create_connection();

    //使用者資料
    $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = execute_sql($link, "ebizlearn_th", $sql);

    $row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html>
  <head>
    <title>修改會員資料</title>
    <meta charset="utf-8">
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.account.value.length == 0)
        {
          alert("「使用者帳號」未填寫!");
          return false;
        }
        if (document.myForm.account.value.length > 20 || document.myForm.account.value.length <= 5)
        {
          alert("「使用者帳號」請勿小於6或大於20個字!");
          return false;
        }
        if (document.myForm.password.value.length == 0)
        {
          alert("「使用者密碼」未填寫!");
          return false;
        }
        if (document.myForm.password.value.length > 20 || document.myForm.password.value.length <= 5)
        {
          alert("「使用者密碼」請勿小於6或大於20個字!");
          return false;
        }
        if (document.myForm.re_password.value.length == 0)
        {
          alert("「密碼確認」未填寫!");
          return false;
        }
        if (document.myForm.password.value != document.myForm.re_password.value)
        {
          alert("「密碼確認」錯誤!!! 請檢查密碼!!!");
          return false;
        }
        if (document.myForm.fname.value.length == 0)
        {
          alert("您的姓氏未填寫！");
          return false;
        }
        if (document.myForm.lname.value.length == 0)
        {
          alert("您的名字未填寫！");
          return false;
        }
        if (document.myForm.cellphone.value.length == 0)
        {
          alert("您的行動電話未填寫！");
          return false;
        }
        if (document.myForm.email.value.length == 0)
        {
          alert("您的E-mail未填寫！");
          return false;
        }
        myForm.submit();
      }
    </script>
  </head>
  <body>
    <p align="center"><img src="modify.jpg"></p>
    <form name="myForm" method="post" action="update.php" >
      <table border="2" align="center" bordercolor="#6666FF">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">請填入下列資料 (標示「*」欄位請務必填寫)</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者帳號：</td>
          <td> 
            <input type="text" name="account" size="20" value="<?php echo $row{"user_account"} ?>">
            (請使用英文或數字鍵)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者密碼：</td>
          <td> 
            <input type="password" name="password" size="20" value="<?php echo $row{"user_password"} ?>">
            (請使用英文或數字鍵)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*密碼確認：</td>
          <td>
            <input type="password" name="re_password" size="20" value="<?php echo $row{"user_password"} ?>">
            (再輸入一次密碼，並記下您的使用者名稱與密碼)
          </td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*姓氏：</td>
          <td><input type="text" name="fname" size="5" value="<?php echo $row{"user_fname"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*名字：</td>
          <td><input type="text" name="lname" size="10" value="<?php echo $row{"user_lname"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*性別：</td>
          <td> 
            <input type="radio" name="sex" value="男" checked>男 
            <input type="radio" name="sex" value="女">女
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">電話：</td>
          <td> 
            <input type="text" name="telephone" size="20" value="<?php echo $row{"user_telephone"} ?>">
            (依照 (02) 2311-3836 格式 or (04) 657-4587)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*行動電話：</td>
          <td> 
            <input type="text" name="cellphone" size="20" value="<?php echo $row{"user_cellphone"} ?>">
            (依照 (0922) 302-228 格式)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*E-mail 帳號：</td>
          <td><input type="text" name="email" size="40" value="<?php echo $row{"user_email"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">地址：</td>
          <td><input type="text" name="address" size="50" value="<?php echo $row{"user_address"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">個人網站：</td>
          <td><input type="text" name="url" size="50" value="<?php echo $row{"user_url"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
            <input type="button" value="修改資料" onClick="check_data()">
            <input type="reset"  value="重新填寫">
			<input type="button" value="取消修改" onclick="location.href='main.php'">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
<?php
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>