<?php 
	//php錯誤回報關閉
	error_reporting(0);

    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//網域
	$ip='www.ebizlearning.com.my/';
	
	//關鍵字
    $char = $_POST["char"];
    
	//關鍵字搜尋
    $search = "SELECT * FROM task WHERE task_name LIKE '%$char%' OR task_block LIKE '%$char%'";
    $check_search = mysqli_query($link,$search); 
    
	//查無關鍵字
    if(mysqli_num_rows($check_search)==0){
        echo "該任務不存在"; 
    }else{
        
		//列出所有查詢，依最新、熱門、主線、支線、活動分類
        $newest_task="SELECT task_number,task_name,task_block,task_picture,task_date FROM task 
                    WHERE task_show=1 AND task_name LIKE '%$char%' OR task_block LIKE '%$char%' ORDER BY task_date DESC LIMIT 10";
        $hot_task="SELECT task_number,task_name,task_block,task_picture,task_hot FROM task 
                    WHERE task_show=1 AND task_name LIKE '%$char%' OR task_block LIKE '%$char%' ORDER BY task_hot DESC LIMIT 10";
        $first_task="SELECT task_number,task_name,task_block,task_picture,task_type FROM task 
                    WHERE task_type=1 AND task_show=1 AND (task_name LIKE '%$char%' OR task_block LIKE '%$char%') ORDER BY task_number ASC";
        $second_task="SELECT task_number,task_name,task_block,task_picture,task_type FROM task 
                    WHERE task_type=2 AND task_show=1 AND (task_name LIKE '%$char%' OR task_block LIKE '%$char%') ORDER BY task_number ASC";
        $three_task="SELECT task_number,task_name,task_block,task_picture,task_type FROM task 
                    WHERE task_type=3 AND task_show=1 AND (task_name LIKE '%$char%' OR task_block LIKE '%$char%') ORDER BY task_number ASC";   
    
        $check_newest_task = mysqli_query($link,$newest_task);
        $check_hot_task = mysqli_query($link,$hot_task);
        $check_first_task = mysqli_query($link,$first_task);
        $check_second_task = mysqli_query($link,$second_task);
        $check_three_task = mysqli_query($link,$three_task);
        
        while($newest_task_row = mysqli_fetch_assoc($check_newest_task))
                $newest_task_output[] = $newest_task_row;
        while($hot_task_row = mysqli_fetch_assoc($check_hot_task))
                $hot_task_output[] = $hot_task_row;
        
        print(json_encode($newest_task_output,JSON_UNESCAPED_UNICODE));
        print(json_encode($hot_task_output,JSON_UNESCAPED_UNICODE));
        
        if(mysqli_num_rows($check_first_task)!=0){
            while($first_task_row = mysqli_fetch_assoc($check_first_task)){
				$first_task_row[task_picture]=$ip.$first_task_row[task_picture];
                $first_task_output[] = $first_task_row;
			}
            print(json_encode($first_task_output,JSON_UNESCAPED_UNICODE));       
        }   
        if(mysqli_num_rows($check_second_task)!=0){
            while($second_task_row = mysqli_fetch_assoc($check_second_task)){
				$second_task_row[task_picture]=$ip.$second_task_row[task_picture];
				$second_task_output[] = $second_task_row;
			}
            print(json_encode($second_task_output,JSON_UNESCAPED_UNICODE));
        }  
        if(mysqli_num_rows($check_three_task)!=0){
            while($three_task_row = mysqli_fetch_assoc($check_three_task)){
				$three_task_row[task_picture]=$ip.$three_task_row[task_picture];
				$three_task_output[] = $three_task_row;
			}
            print(json_encode($three_task_output,JSON_UNESCAPED_UNICODE));
        }
        
    }
    mysqli_close($link);
?>