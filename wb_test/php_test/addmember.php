<?php
  require_once("dbtools.inc.php");
  date_default_timezone_set('Asia/Taipei');
  
  //取得表單資料
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
  $date= date ("Y-m-d H:i:s") ;

  $link = create_connection();
  
  //檢查帳號是否有人申請
  $sql = "SELECT * FROM user WHERE user_account = '$account'";
  $result = execute_sql($link, "ebizlearn_th", $sql);
  
  //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    mysqli_free_result($result);

    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>
            alert('您所指定的帳號已經有人使用，請使用其它帳號');
            history.back();
          </script>";
  }

  //如果帳號沒人使用
  else
  {
    mysqli_free_result($result);

    //新增帳號
    $sql = "INSERT INTO user (user_account, user_password, user_fname, user_lname, user_sex, 
             user_telephone, user_cellphone, user_email, user_address, user_url) 
             VALUES ('$account','$password','$fname','$lname','$sex','$telephone','$cellphone','$email','$address','$url')";
    $result = execute_sql($link, "ebizlearn_th", $sql);
    
    //查ID
    $sql = "SELECT * FROM user WHERE user_account = '$account'";
    $result = execute_sql($link, "ebizlearn_th", $sql);
    $row = mysqli_fetch_array($result);
    
	$id = $row['user_id'];
	
	//新增該帳號的HAVE關係
    $insert_have = "INSERT INTO have (have_id,have_number,have_story_part) SELECT user_id,task_number,story_part 
                            FROM  user,task INNER JOIN story ON task_number=story_number WHERE user_id='$id'";
    $connect_have = mysqli_query($link,$insert_have);
	
    //新增資料夾
    $path = 'C:/xampp/htdocs/picture/'.$row['user_id'];
    mkdir($path,0777,true);
	

    //將使用者資料加入 cookies
    setcookie("user_id", $id);
    setcookie("passed", "TRUE");
	
	//是否進會員專區
	echo"<script type='text/javascript'>
			x=confirm('註冊成功!是否進入會員專區!')
				if(x){
					location.assign('main.php');
                }else{                                
					location.assign('index.htm');
				}
		</script>";
	

  }
  mysqli_close($link);
?>
