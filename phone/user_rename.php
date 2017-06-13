<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//更改帳號資訊
    $id = $_POST["id"];
    $account = $_POST["account"];
    $password = $_POST["password"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $sex = $_POST["sex"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    
	//找不重複的帳號
    $user = "SELECT * FROM user WHERE user_account='$account' AND user_id != '$id'";
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
			//更新該帳號資訊，以ID辨識
            $update_user = "UPDATE user SET user_account='$account',user_password='$password',user_fname='$fname',user_lname='$lname',
                            user_email='$email',user_cellphone='$phone',user_sex='$sex',user_address='$address'
                            WHERE user_id='$id'";
                                
            $connect_user = mysqli_query($link,$update_user);
                      
            if ($connect_user) {
                echo "Update Sucessfully";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }    
        }
    }
    mysqli_close($link);
?>
