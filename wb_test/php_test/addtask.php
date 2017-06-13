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
        mysqli_free_result($result);
        
        //確定故事數量
        for($i=0 ; $i<count($story_name_array) ; $i++)
        {
            $name = $story_name_array[$i];
            $address = $story_address_array[$i];
            $data = $story_data_array[$i];
               
            if($name!="" && $address!="" && $_FILES["story_picture"]["name"][$i] != "" && $data!="")
            {                   
                $sum_task++;
            }
        }
        //至少一個故事
        if($sum_task <= 0)
        {
            echo "<script type='text/javascript'>
                    alert('新增失敗! 請至少填滿一個故事內容!');
                    history.back();
                  </script>";
        }
        else
        {
            //新增任務內容
            $sql = "INSERT INTO task(task_name,task_block,task_type,task_introduction,task_part,task_developer)
                    VALUES('$task_name','$task_block','$task_type','$task_introduction','$sum_task','$task_developer')";
            $result = execute_sql($link, "ebizlearn_th", $sql);
            
            if($result==0)
            {
                echo "<script type='text/javascript'>
                        alert('任務新增失敗! 請檢查任務內容是否已填妥!');
                        history.back();
                      </script>";
            }
            else
            {   
                //任務編號
                $sql = "SELECT task_number FROM task WHERE task_name='$task_name' AND task_developer='$task_developer'";
                $task_number = execute_sql($link, "ebizlearn_th", $sql);
                $row = mysqli_fetch_array($task_number);
                
                //新增圖片資料夾
                $path = $file.$task_developer.'/'.$row['task_number'];
                mkdir($path,0777,true);
                $path = $path.'/'.'main'.'.'.'jpg';
                move_uploaded_file($_FILES["task_picture"]["tmp_name"], $path);
                
                //任務圖片URL
                $path = '../picture/'.$task_developer.'/'.$row['task_number'].'/'.'main'.'.'.'jpg';
                $sql = "UPDATE task SET task_picture='$path' WHERE task_number='$row[task_number]'  AND task_developer='$task_developer'";
                $result = execute_sql($link, "ebizlearn_th", $sql);
                
                //寫入故事
                for($i=0 ; $i<count($story_name_array) ; $i++)
                {
                    $name = $story_name_array[$i];
                    $address = $story_address_array[$i];
                    $data = $story_data_array[$i];
                
                    //新增故事
                    if($name!="" && $address!="" && $_FILES["story_picture"]["name"][$i] != "" && $data!="")
                    {   
                        $sql = "INSERT INTO story(story_number,story_name,story_address,story_data,story_part)
                                VALUES('$row[task_number]','$name','$address','$data','$j')";
                        $result = execute_sql($link, "ebizlearn_th", $sql);             
                        
                        //故事編號
                        $sql = "SELECT * FROM story WHERE story_number='$row[task_number]' AND story_part='$j'";
                        $result = execute_sql($link, "ebizlearn_th", $sql);             
                        
                        //故事圖片
                        $path = $file.$task_developer.'/'.$row['task_number'].'/'.$j.'.'.'jpg';                      
                        move_uploaded_file($_FILES["story_picture"]["tmp_name"][$i],$path);
                        
                        //故事圖片URL
                        $path = '../picture/'.$task_developer.'/'.$row['task_number'].'/'.$j.'.'.'jpg';
                        $sql = "UPDATE story SET story_picture='$path' WHERE story_number='$row[task_number]' AND story_part='$j'";
                        $result = execute_sql($link, "ebizlearn_th", $sql);             
                        
                        $j++;
                    }
                    
                }
                
                $sql = "INSERT INTO have (have_id,have_number,have_story_part) SELECT user_id,task_number,story_part 
                                    FROM  user,task INNER JOIN story ON task_number=story_number WHERE task_number='$row[task_number]'";
                $result = execute_sql($link, "ebizlearn_th", $sql);
                
				//是否繼續新增
                echo"<script type='text/javascript'>
						x=confirm('新增成功! 是否繼續新增!')
							if(x){
								location.assign('newtask.php'); 
							}else{                                
								location.assign('main.php');
							}
                       </script>";
            }    
        }                  
    }            
    mysqli_close($link); 
  }
?>


