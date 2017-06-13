<?php 
	//php錯誤回報關閉
	error_reporting(0);

    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//帳號ID、任物編號
    $id = $_POST["user_id"];
    $number = $_POST["task_number"];
    
	//網域
	$ip='www.ebizlearning.com.my/';
	
	
	//找任務詳情
    $user = "SELECT * FROM have WHERE have_id='$id' AND have_number='$number'";
    $check_user = mysqli_query($link,$user); 
    
	//如無該任務
    if(mysqli_num_rows($check_user)==0){
        echo "該任務已不存在"; 
    }else{
        
		//該帳號與任務關係、任務詳情、該任務的故事詳情
        $have_data="SELECT DISTINCT have_flag FROM have 
                    WHERE have_id='$id' 
                    AND have_number='$number' 
                    ORDER BY have_number ASC";
        
        $task_data="SELECT * FROM task WHERE task_number='$number'";
        
        $story_data="SELECT story_name,story_part,story_picture,story_address 
                    FROM story WHERE EXISTS
                    (SELECT * FROM task 
                    WHERE task_number='$number'  
                    AND story_number=task_number)
                    ORDER BY story_part ASC";
        
        $have_result=mysqli_query($link,$have_data);
        $task_result=mysqli_query($link,$task_data);
        $story_result=mysqli_query($link,$story_data); 
        
        while($have_row = mysqli_fetch_assoc($have_result))
            $have_output[] = $have_row;
        while($task_row = mysqli_fetch_assoc($task_result)){
			$task_row[task_picture]=$ip.$task_row[task_picture];
            $task_output[] = $task_row;
		}
        while($story_row = mysqli_fetch_assoc($story_result)){
            $story_row[task_picture]=$ip.$story_row[task_picture];
			$story_output[] = $story_row;
		}
        
        print(json_encode($have_output,JSON_UNESCAPED_UNICODE));
        print(json_encode($task_output,JSON_UNESCAPED_UNICODE));
        print(json_encode($story_output,JSON_UNESCAPED_UNICODE));
    }
    
    
    mysqli_close($link);
?>