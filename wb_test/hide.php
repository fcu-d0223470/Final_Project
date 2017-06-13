<?php
    require_once("dbtools.inc.php");
						
    //建立資料連接
    $link = create_connection();

	$user_id = $_COOKIE["user_id"];
	$task_number = $_POST["task_number"];
	$task_show = $_POST["task_show"];

    
    //執行 SQL 命令
    $sql="UPDATE task SET task_show='$task_show' WHERE task_number='$task_number' and task_developer='$user_id'";      
	$result = execute_sql($link, "ebizlearn_th", $sql);
    
    header("location:$_SERVER[HTTP_REFERER]");
    mysqli_close($link);
  
?>