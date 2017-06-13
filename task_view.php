<?php
    require_once("dbtools.inc.php");
						
    //建立資料連接
    $link = create_connection();
			
	$task = $_POST["task_number"];
	
    //執行 SQL 命令
    $sql="SELECT *,task_introduction FROM task,story WHERE task_show=1 and task_number=story_number and task_number='$task'";      
	$result = execute_sql($link, "ebizlearn_th", $sql);
	$result2 = execute_sql($link, "ebizlearn_th", $sql);		
    
	//取得記錄數
    $total_records = mysqli_num_rows($result2);

?>
<!DOCTYPE> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
    
        <title>活動資訊->活動細節</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/task.css" />
             
    </head>
    <body>
<!-- [[ header ]] -->
        <div id="header"><div id="header-inner">
            
            <p id="logo"><img src="common/images/header_id.gif" alt="Nazo Corporaiton" /></p>
            <ul id="globalNavigation">
                <li><a href="#">連絡我們</a></li>
				<?php
					$passed = $_COOKIE["passed"];
		
					if ($passed != "TRUE"){
						echo "<li><a href='login.php'>會員登入</a></li>";
					}else{
						echo "<li><a href='logout.php'>會員登出</a></li>";
                        echo "<li><a href='modify_user.php'>修改資料</a></li>";
					}
				?>
				<li><a href="head.php">回首頁</a></li>
                <input type="search" name="search" id="search">
                <li><a href="#"><img src="common/images/whitet.png" alt="搜尋" /></a></li>
            </ul>
            
        </div></div>
<!-- [[ /header ]] -->
<!-- [[ list ]] -->
       <div id="global_navi"><div id="global_navi-inner">
            <ul>
                <li><a href="active_new.php">活動資訊</a>

                    <ul class="pd">
                        <li><a href="active_new.php">最新活動</a></li>
                        <li><a href="active_hot.php">熱門活動</a></li>
                        <li><a href="active_type1.php">主線活動</a></li>
                        <li><a href="active_type2.php">支線活動</a></li>
                        <li><a href="active_type3.php">限時活動</a></li>
                    </ul>
                </li>
                <li><a href="member_new.php">會員專區</a>
                    <ul class="pd">
                        <li><a href="member_new.php">普通會員</a></li>
                        <li><a href="developer.php">高級會員</a></li>
                    </ul>
                </li>
                <li><a href="#">相關問題</a></li>
            </ul>
       </div></div>

<!-- [[ /list ]] -->
<!-- [[ contents]] -->
		<div id="contents"><div id="contents-inner">
				<div id="active-head" style="background:#FF7100;"> 
					<p class="button-on" style="margin:0 auto;">活動細節</p>
				</div>
                
				<?php
				$j = 1;
				$row = mysqli_fetch_array($result);
				
				echo"<div id='task'>";
				echo	"<div id='task-content'>";
				echo		"<div id='task-h1'>";
				echo			"<h1>$row[task_name]</h1><br>";
				echo		"</div>";
				echo		"<div id='task-time'>";	
				echo			"<p>$row[task_block] &nbsp;&nbsp;&nbsp;&nbsp; $row[task_date] &nbsp;&nbsp;&nbsp;&nbsp; $row[task_hot]</p><br>";
				echo		"</div>";
				echo		"<div id='task-inner'>";
				echo			"<img src='$row[task_picture]'>";
				echo			"<p>$row[task_introduction]</p><br>";
				echo		"</div>";
				echo	"</div>";
				echo"</div>";
				
				if($total_records>9){
					echo"<div id='story-list' style='height:1360px;'>";
				}else if($total_records>6){
					echo"<div id='story-list' style='height:1020px;'>";
				}else if($total_records>3){
					echo"<div id='story-list' style='height:680px;'>";
				}else{
					echo"<div id='story-list' style='height:340px;'>";
				}
				
				while($row = mysqli_fetch_array($result2) and $j <=$total_records){
				
				echo	"<div id='story'><div id='story-inner'>";
				echo	"<img src='$row[story_picture]'>";
				echo		"<p>$row[story_name]</p>";
				echo		"<p>$row[story_address]</p>";
				echo	"</div></div>";
					
					$j++;
				}
				
				echo"</div>";
				
				?>
				
				
				
		</div></div>
<!-- [[ /contents ]] -->
<!-- [[ 工具 ]] -->
		<div id="backtop">
			<div id="backbth">
				<a href="">Top</a>
			</div>
			<div id="backbth">
				<a href="javascript:window.history.back(1);">上一步</a>
			</div>
		</div>
<!-- [[ 工具 ]] -->
<!-- [[ footer ]] -->
        <div id="footer"><div id="footer-inner">
            
            <ul id="siteinfoNavigation">
                <li><a href="active_new.php">活動資訊</a></li>
                <li><a href="member_new.php">會員專區</a></li>
                <li><a href="#">常見問題</a></li>
				<li><a href="head.php">回首頁</a></li>
            </ul>
            <address>郭子奇股份有限公司  版權所有  電話 : 0936782861<br>
            地址 : 台中市西屯區逢甲大學育樂館2樓</address>
            
        </div></div>
<!-- [[ /footer ]] -->

    </body>
</html>
<?php
    mysqli_free_result($result);
    mysqli_close($link);
  
?>