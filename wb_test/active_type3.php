<?php
    require_once("dbtools.inc.php");
			
    //指定每頁顯示幾筆記錄
    $records_per_page = 3;
			
    //取得要顯示第幾頁的記錄
    if (isset($_GET["page"]))
       $page = $_GET["page"];
    else
       $page = 1;
				
    //建立資料連接
    $link = create_connection();
			
    //執行 SQL 命令
    $sql="SELECT *,task_introduction FROM task WHERE task_show=1 and task_type=3 ORDER BY task_date DESC";      
	$result = execute_sql($link, "ebizlearn_th", $sql);
			
    //取得欄位數
    $total_fields = mysqli_num_fields($result);
			
    //取得記錄數
    $total_records = mysqli_num_rows($result);
			
    //計算總頁數
    $total_pages = ceil($total_records / $records_per_page);
			
    //計算本頁第一筆記錄的序號
    $started_record = $records_per_page * ($page - 1);
			
    //將記錄指標移至本頁第一筆記錄的序號
    mysqli_data_seek($result, $started_record);
?>
<!DOCTYPE> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
    
        <title>活動資訊->限時活動</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/active.css" />
        
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
				<div id="active-head"> 
					<a href="active_new.php"  ><input class="button-off" type="submit"  value="最新活動"></a>
					<a href="active_hot.php"  ><input class="button-off" type="submit"  value="熱門活動"></a>
					<a href="active_type1.php"><input class="button-off" type="submit"  value="主線活動"></a>
					<a href="active_type2.php"><input class="button-off" type="submit"  value="支線活動"></a>
					<a href="active_type3.php"><input class="button-on"  type="submit"  value="限時活動"></a>
				</div>

				<?php
				$j = 1;
				while ($row = mysqli_fetch_array($result) and $j <= $records_per_page){
				
				echo "<div id='active'>";
				echo 	"<div id='active-content'>";
				echo		"<img src ='$row[task_picture]'>";
				echo		"<div id='active-time'>";
				echo			"<p>$row[task_block] &nbsp;&nbsp;&nbsp;&nbsp; $row[task_date] &nbsp;&nbsp;&nbsp;&nbsp; $row[task_hot]</p><br>";
				echo		"</div>";
				echo		"<div id='active-h1'>";
				echo			"<h1>$row[task_name]</h1><br>";
				echo		"</div>";
				echo		"<div id='active-inner'>";
				echo			"<p>$row[task_introduction]</p><br>";
				echo		"</div>";
				echo	"</div>";
				echo	"<div id='active-tool'>";
				echo		"<div id='active-look'>";
				echo			"<form method='POST' action='task_view.php'>";
				echo				"<input name='task_number'	type='hidden' value='$row[task_number]' />";
				echo				"<input name='Submit1'		type='submit' value='查看' />";
				echo			"</form>";
				echo		"</div>";
				echo	"</div>";
				
				echo"</div>";
					$j++;
				}
				
                echo "<div id='navi-bar'><ul>";
                    
                    if ($page > 1)
                    echo "<li> <a href='active_type3.php?page=". ($page - 1) . "'>上</a> </li>";
				
                    for ($i = 1; $i <= $total_pages; $i++)
                    {
                        if ($i == $page)
                            echo "<li>$i </li>";
                        else
                            echo "<li><a href='active_type3.php?page=$i'>$i</a> </li>";		
                    }
			
                    if ($page < $total_pages)
                        echo "<li> <a href='active_type3.php?page=". ($page + 1) . "'>下</a> </li></ul>";
                   
				   
                echo "</div>"; 
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