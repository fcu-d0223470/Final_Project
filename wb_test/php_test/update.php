<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];

  /*  如果 cookie 中的 passed 變數不等於 TRUE，
      表示尚未登入網站，將使用者導向首頁 index.htm */
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }

  /*  如果 cookie 中的 passed 變數等於 TRUE，
      表示已經登入網站，則取得使用者資料 */
  else
  {
    require_once("dbtools.inc.php");

    //取得 modify.php 網頁的表單資料
    $id = $_COOKIE["user_id"];
    $account = $_POST["account"]; 
    $password = $_POST["password"]; 
    $fname = $_POST["fname"]; 
    $lname = $_POST["lname"];
    $sex = $_POST["sex"];
    $telephone = $_POST["telephone"]; 
    $cellphone = $_POST["cellphone"]; 
    $email = $_POST["email"];   
    $address = $_POST["address"];
    $url = $_POST["url"];

    //建立資料連接
    $link = create_connection();

    //更新使用者資料
    $sql = "UPDATE user SET user_account='$account', user_password = '$password', user_fname = '$fname', user_lname = '$lname', 
			user_sex = '$sex', user_telephone = '$telephone', user_cellphone = '$cellphone', user_address = '$address',
            user_email = '$email', user_url = '$url'
            WHERE user_id = '$id'";
    $result = execute_sql($link, "ebizlearn_th", $sql);
	
	//是否繼續修改	
	echo"<script type='text/javascript'>
			x=confirm('恭喜您已經修改資料成功了!是否返回會員專區!')
				if(x){
					location.assign('main.php'); 
                }else{                                
					location.assign('modify.php');
				}
		</script>";
	
    //關閉資料連接
    mysqli_close($link);
  }
?>