<?php
  require_once("dbtools.inc.php");
  date_default_timezone_set('Asia/Taipei');
  
  //取得表單資料
  $user_id = $_COOKIE["user_id"];
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

  $link = create_connection();
  
  //檢查帳號是否有其他人申請過
  $sql = "SELECT * FROM user WHERE user_account = '$account' and user_id != '$user_id'";
  $result = execute_sql($link, "ebizlearn_th", $sql);
  
  //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    mysqli_free_result($result);

    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>
            alert('您所指定的帳號已經有人使用，請使用其它帳號');
            location.assign('modify_user.php');
          </script>";
  }
  //如果帳號沒人使用
  else
  {
    mysqli_free_result($result);

    //更新使用者資料
    $sql = "UPDATE user SET user_account='$account', user_password = '$password', user_fname = '$fname', user_lname = '$lname', user_sex = '$sex', 
            user_telephone = '$telephone', user_cellphone = '$cellphone', user_address = '$address',user_email = '$email', user_url = '$url'
            WHERE user_id = '$user_id'";
            
    $result = execute_sql($link, "ebizlearn_th", $sql);
	
	//是否繼續修改	
	echo"<script type='text/javascript'>
			x=confirm('恭喜您已經修改資料成功了!是否返回會員專區!')
				if(x){
					location.assign('member_new.php'); 
                }else{                                
					location.assign('modify_user.php');
				}
		</script>";
	

  }
  mysqli_close($link);
?>
