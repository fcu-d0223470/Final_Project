<?php
    require_once("dbtools.inc.php");
						
    //建立資料連接
    $link = create_connection();
    
	$user_id = $_COOKIE["user_id"];
	$task_number = $_POST["task_number"];
	$have_flag = $_POST["have_flag"];
    
    if($have_flag == 1){
        $sql="UPDATE have,task SET have_flag='$have_flag',task_hot=task_hot+1 WHERE have_number='$task_number' and have_id='$user_id' and task_number=have_number";      
        $result = execute_sql($link, "ebizlearn_th", $sql);
    }else{
        $sql="UPDATE have,task SET have_flag='$have_flag',task_hot=task_hot-1 WHERE have_number='$task_number' and have_id='$user_id' and task_number=have_number";      
        $result = execute_sql($link, "ebizlearn_th", $sql);
    }
    
    header("location:$_SERVER[HTTP_REFERER]");
    mysqli_close($link);
  
?>