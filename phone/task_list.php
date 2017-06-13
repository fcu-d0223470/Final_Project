<?php 
    include_once("connect.php");      
    $link=Connection();      
    mysqli_query($link,'set names utf8');
    
	//列出任務列表，依最新、熱門、主線、支線、活動分類
    $newest_task="SELECT task_number,task_name,task_block,task_picture,task_type,task_hot,task_date FROM task WHERE task_show=1";
        
    $check_newest_task = mysqli_query($link,$newest_task);
    
    while($newest_task_row = mysqli_fetch_assoc($check_newest_task))
            $newest_task_output[] = $newest_task_row;
		
    $output_result=array('web_list'=>$newest_task_output);
	print(json_encode($output_result,JSON_UNESCAPED_UNICODE));
	//print(json_encode(array('web_list'=>$newest_task_output,JSON_UNESCAPED_UNICODE)));
    
    mysqli_close($link);
?>