<?php

    require_once("dbtools.inc.php");
						
    //建立資料連接
    $link = create_connection();
    
	$user_id = $_COOKIE["user_id"];
	$task_number = $_POST["task_number"];
    
    $sql="UPDATE task SET task_developer='',task_show=0 WHERE task_number='$task_number' and task_developer='$user_id'";      
    $result = execute_sql($link, "ebizlearn_th", $sql);
    
    header("location:$_SERVER[HTTP_REFERER]");
    mysqli_close($link);
  
?>