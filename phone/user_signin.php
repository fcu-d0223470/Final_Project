<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//帳號、密碼、手機編號
    $account = $_POST["account"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
    
	//檢查帳號
    $user = "SELECT * FROM user WHERE user_account='$account' AND user_password='$password'";
    $check_user = mysqli_query($link,$user);
    $row = mysqli_fetch_array($check_user);
    
	//檢查手機編號
    $user_phone_number = "SELECT * FROM user WHERE user_account='$account' AND user_phone_number='$phone_number'";
    $check_user_phone_number = mysqli_query($link,$user_phone_number);
    
	//如果有更換手機
    $user_change_phone = "SELECT * FROM user WHERE user_account='$account' AND user_phone_number=''";
    $check_user_change_phone = mysqli_query($link,$user_change_phone);

    //如無該帳號
    if(mysqli_num_rows($check_user)==0){
        echo "查無此人!請檢查帳號或密碼是否輸入正確!"; 
    }else{         
		//如果有該帳號且手機編號正確或為空的，給手機該帳號的所有資料
		if(mysqli_num_rows($check_user_phone_number)!=0 || mysqli_num_rows($check_user_change_phone)!=0){
			
			$update_user="UPDATE user SET user_phone_number='$phone_number' WHERE user_id='$row[user_id]'";
            
            $data_usar="SELECT * FROM user WHERE user_id='$row[user_id]'";
            
            $data_have="SELECT DISTINCT * FROM have WHERE have_id='$row[user_id]' AND have_number IN
                       (SELECT have_number FROM have WHERE have_id='$row[user_id]' 
                        AND (have_flag=1 OR have_task_flag=1 OR have_story_flag=1))
                        ORDER BY have_number ASC,have_story_part ASC";
                        
            $data_task="SELECT DISTINCT * FROM task WHERE EXISTS
                        (SELECT * FROM have WHERE have_id='$row[user_id]' AND have_number=task_number 
                        AND (have_flag=1 OR have_task_flag=1 OR have_story_flag=1))
                        ORDER BY task_number ASC"; 

            $data_story="SELECT DISTINCT * FROM story WHERE EXISTS
                        (SELECT * FROM have,task WHERE have_id='$row[user_id]'
                        AND have_number=task_number AND story_number=task_number
                        AND (have_flag=1 OR have_task_flag=1 OR have_story_flag=1))
                        ORDER BY story_number ASC,story_part ASC";        
                        
            $connect_update=mysqli_query($link,$update_user);
            $connect_user=mysqli_query($link,$data_usar);
            $connect_have=mysqli_query($link,$data_have);
            $connect_task=mysqli_query($link,$data_task);
            $connect_story=mysqli_query($link,$data_story);
            
            while($user_row = mysqli_fetch_assoc($connect_user))
                $user_output[] = $user_row;
            print(json_encode($user_output,JSON_UNESCAPED_UNICODE));            
                      
            if(mysqli_num_rows($connect_have)!=0){
                while($have_row = mysqli_fetch_assoc($connect_have))
                    $have_output[] = $have_row;   
                while($task_row = mysqli_fetch_assoc($connect_task))
                    $task_output[] = $task_row; 
                while($story_row = mysqli_fetch_assoc($connect_story))
                    $story_output[] = $story_row;
            
                print(json_encode($have_output,JSON_UNESCAPED_UNICODE));
                print(json_encode($task_output,JSON_UNESCAPED_UNICODE));           
                print(json_encode($story_output,JSON_UNESCAPED_UNICODE));
            }
			
        }else{
			//如果有該帳號但手機編號錯誤
            echo "該帳號已綁定其他手機!"."</br>";
            echo "請從原手機的設定裡"."</br>";
            echo "按轉移手機帳號的按鈕!";
        }
    }
    
    mysqli_close($link);
?>