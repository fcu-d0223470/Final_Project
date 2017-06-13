<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
        
    $account = $_POST["account"];
    $email = $_POST["email"];
        
    $user = "SELECT * FROM user WHERE user_account='$account' AND user_email='$email'";       
    $check_user = mysqli_query($link,$user);
        
    if(mysqli_num_rows($check_user)==0){
        echo "查無此人!請檢查帳號或E-mail是否輸入正確!";  
    }else{ 
    
        while($row = mysqli_fetch_assoc($check_user)){    
            echo "你好!".$row['user_fname'].$row['user_lname']."</br>";
            echo "你的密碼:".$row['user_password']."</br>";
        }
        
    }    
    mysqli_close($link);
?>