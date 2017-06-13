<?php 
	//php錯誤回報關閉
	error_reporting(0);
	
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//網域
	$ip='www.ebizlearning.com.my/';
	
	//找5個最新的任務
    $newest_task="SELECT *,task_picture FROM task WHERE task_show=1 ORDER BY task_date DESC Limit 5";
    $check_newest_task = mysqli_query($link,$newest_task);
	
    
    while($task_row = mysqli_fetch_array($check_newest_task)){
            $task_row[task_picture]=$ip.$task_row[task_picture];
			$task_output[] = $task_row;
	}

    print(json_encode($task_output,JSON_UNESCAPED_UNICODE));
    
    mysqli_close($link);
?>