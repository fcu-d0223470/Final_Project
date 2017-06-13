<?php 
	 require_once("dbtools.inc.php");		

      $link = create_connection();
			
    
    $number = $_POST["task_number"];
    
	//找是該ID跟任務編號的HAVE關係
    $user = "SELECT * FROM task WHERE task_number='$number'";
    $check_user = execute_sql($link, "ebizlearn_th", $user); 
    
	//找無該關係
    if(mysqli_num_rows($check_user)!=0){ 
		//接受任務，拿任務詳情
        $update_flag="UPDATE have,task SET have_flag=1,task_hot=task_hot+1
                      WHERE  AND have_number='$number' AND task_number=have_number";        
         
        $have_data="SELECT * FROM have WHERE  AND have_number='$number' ORDER BY have_number ASC";        
        
        $task_data="SELECT * FROM task WHERE task_number='$number'";
           
        $story_data="SELECT * FROM story WHERE EXISTS
                    (SELECT * FROM task 
                    WHERE task_number='$number'  
                    AND story_number=task_number)
                    ORDER BY story_part ASC";   
                        
        $update_result=mysqli_query($link,$update_flag); 
        $have_result=mysqli_query($link,$have_data);
        $task_result=mysqli_query($link,$task_data);            
        $story_result=mysqli_query($link,$story_data);

        while($task_row = mysqli_fetch_assoc($task_result))
            $task_output[] = $task_row;                            
        while($story_row = mysqli_fetch_assoc($story_result))
            $story_output[] = $story_row;

        print(json_encode($task_output,JSON_UNESCAPED_UNICODE));
        print(json_encode($story_output,JSON_UNESCAPED_UNICODE));

    }
    mysqli_close($link);
?>