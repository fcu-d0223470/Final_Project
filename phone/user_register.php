<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
	
	//把時間訂為台北標準
    date_default_timezone_set('Asia/Taipei');
   
	//註冊帳號資料
    $account = $_POST["account"];
    $password = $_POST["password"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $sex = $_POST["sex"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    $date= date ("Y-m-d H:i:s") ;
    
    //找不重複的帳號
    $user = "SELECT * FROM user WHERE user_account='$account'";
    $check_user = mysqli_query($link,$user);  
    
	//有重複帳號
    if(mysqli_num_rows($check_user)!=0){
        echo "此帳號已經有人"; 
    }else{
        if(empty($account) || strlen($account)<6 || strlen($account)>20 || (preg_match("/^[A-Za-z0-9]+$/",$account)==false) )
            echo "Please Input Account Name";
        else if(empty($password) || strlen($password)<6 || strlen($password)>20 || (preg_match("/^[A-Za-z0-9]+$/",$password)==false) ) 
            echo "Please Input Password!";
        else if(empty($fname) || mb_strlen($fname,'utf-8')>10) 
            echo "Please Input Fname!";
        else if(empty($lname) || mb_strlen($lname,'utf-8')>20) 
            echo "Please Input Your Lname!";
        else if(empty($email ) || strlen($email)<6 || (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)==false) ) 
            echo "Please Input Your E-Mail!";
        else if(empty($phone) || strlen($phone)>20 || (preg_match("/^[0-9]+$/",$phone)==false)) 
            echo "Please Input Phone Number!";
        else if(empty($sex) ) 
            echo "Please Select Sex!";
        else if(empty($address) ) 
            echo "Please Input Address!";
        else{    
			//新增該帳號
            $insert_user = "INSERT INTO user (user_account,user_password,user_fname,user_lname,user_email,user_cellphone,user_sex,user_address,user_phone_number,user_date)
                            VALUES ('$account','$password','$fname','$lname','$email','$phone','$sex','$address','$phone_number','$date')";    
            $connect_user = mysqli_query($link,$insert_user);
			
			//找該帳號ID
            $user_id = "SELECT user_id FROM user WHERE user_account='$account'";
            $connect_id = mysqli_query($link,$user_id);
            $row = mysqli_fetch_array($connect_id);
            
			//新增該帳號的HAVE關係
            $insert_have = "INSERT INTO have (have_id,have_number,have_story_part) SELECT user_id,task_number,story_part 
                            FROM  user,task INNER JOIN story ON task_number=story_number WHERE user_id='$row[user_id]'";
            $connect_have = mysqli_query($link,$insert_have);
            
            if ($connect_user && $connect_id && $connect_have) {
                echo "Signup Sucessfully ".$row['user_id'];
            }else{
                echo "Error!!!";
            }    
        }
    }
    mysqli_close($link);
?>
