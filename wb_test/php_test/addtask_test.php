<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
	
  /*  如果 cookie 中的 passed 變數不等於 TRUE，
      表示尚未登入網站，將使用者導向首頁 index.htm */
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }
  else
  {
    require_once("dbtools.inc.php");
   
    $file='C:/xampp/htdocs/picture/';
    $sum_task = 0;
    $j = 1;
    
    $task_developer = $_COOKIE["user_id"];
    $task_name = $_POST["task_name"];
    $task_block = $_POST["task_block"];
    $task_type = $_POST["task_type"];
    $task_introduction = $_POST["task_introduction"];      
    
    $story_name_array = $_POST["story_name"];
    $story_address_array = $_POST["story_address"];
    $story_data_array = $_POST["story_data"];
      
    $link = create_connection();
  
    //檢查任務名稱是否有使用過  
    $sql = "SELECT * FROM task WHERE task_developer = '$task_developer' AND task_name = '$task_name'";
    $result = execute_sql($link, "ebizlearn_th", $sql);
     
    if(mysqli_num_rows($result) != 0)
    {
        mysqli_free_result($result);

        echo "<script type='text/javascript'>
                alert('您已經使用過此任務名稱，請使用其它名稱');
                history.back();
              </script>";
    }
    else
    {
  
        echo '開發者:'.$task_developer.'<br>';
        echo '任務名稱:'.$task_name.'<br>';
        echo '任務區塊:'.$task_block.'<br>';
        echo '任務圖片:'.$_FILES["task_picture"]["name"].'<br>';
        echo '任務型態'.$task_type.'<br>';
        echo '任務介紹:'.$task_introduction.'<br>'.'<br>';
        
         for($i=0 ; $i<count($story_name_array) ; $i++)
        {
            $name = $story_name_array[$i];
            $address = $story_address_array[$i];
            $data = $story_data_array[$i];
               
            if($name!="" && $address!="" && $_FILES["story_picture"]["name"][$i] != "" && $data!="")
            {                   
                $sum_task++;
                
                echo '故事名稱:'.$name.'<br>';
                echo '故事區塊:'.$address.'<br>';
                //echo '故事型態'.$task_type.'<br>';
                echo '故事介紹:'.$data.'<br>'.'<br>';
                
            }
        }

    }            
    mysqli_close($link); 
  }
?>


