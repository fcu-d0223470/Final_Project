<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//HAVE關係flag
    $have_id = $_POST["have_id"];
    $have_number = $_POST["have_number"];
    $have_flag = $_POST["have_flag"];
    $have_task_flag = $_POST["have_task_flag"];
    $have_story_flag = $_POST["have_story_flag"];
    $have_story_part = $_POST["story_part"];
    
	//找到該號所有的HAVE關係
    $find_have = "SELECT * FROM have WHERE have_id='$have_id' AND have_number='$have_number'";
    $find_have_flag = "SELECT have_flag FROM have WHERE have_id='$have_id' AND have_number='$have_number'"; 
    $find_have_task_flag = "SELECT have_task_flag FROM have WHERE have_id='$have_id' AND have_number='$have_number'";
    $find_have_story_flag = "SELECT have_story_flag FROM have WHERE have_id='$have_id' AND have_number='$have_number' AND have_story_part='$have_story_part'";
    
    $check_have = mysqli_query($link,$find_have);
    $check_have_flag = mysqli_query($link,$find_have_flag);
    $check_have_task_flag = mysqli_query($link,$find_have_task_flag);
    $check_have_story_flag = mysqli_query($link,$find_have_story_flag);
    
	
    if(mysqli_num_rows($check_have) == 0){
        echo "沒此HAVE關係!"; 
    }
    if(mysqli_fetch_array($check_have_flag) != '$have_flag')
    {       
        //更新該帳號的have_flag
		$update_have_flag="UPDATE have SET have_flag='$have_flag'
                            WHERE have_id='$have_id' 
                            AND have_number='$have_number'";
        $update = mysqli_query($link,$update_have_flag);    
    }
    if(mysqli_fetch_array($check_have_task_flag) != '$have_task_flag')
    {        
        //更新該帳號的have_task_flag
		$update_have_task_flag="UPDATE have SET have_task_flag='$have_task_flag'
                                WHERE have_id='$have_id' 
                                AND have_number='$have_number'";
        $update = mysqli_query($link,$update_have_task_flag);      
    }
    if(mysqli_fetch_array($check_have_story_flag) != '$have_story_flag')
    {      
        //更新該帳號的have_story_flag
		$update_have_story_flag="UPDATE have SET have_story_flag='$have_story_flag'
                                WHERE have_id='$have_id' 
                                AND have_number='$have_number'
                                AND have_story_part='$have_story_part'";
        $update = mysqli_query($link,$update_have_story_flag);        
    }
    mysqli_close($link);
?>