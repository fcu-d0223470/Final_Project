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
      $sql="SELECT *,task_introduction FROM task WHERE task_show=1 ORDER BY task_date DESC";      
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
    
        <title>活動資訊</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/task.css" />
        
		
	   
	   
		<script type="text/javascript">
			function check_data(){
				if (document.myForm.account.value.length == 0)
					alert("帳號欄位不可以空白哦！");
				else if (document.myForm.password.value.length == 0)
					alert("密碼欄位不可以空白哦！");
				else 
					myForm.submit();
				}
			
			function changeColor(num){
				for(var i=1;i<=5;i++){
					var str = document.getElementById('sub_'+i);
				
					if(i==num){
						str.className="button-on";
					}else{
						str.className="button-off";
					}
				}
			}
			
		</script>
        
    </head>
    <body>
<!-- [[ php ]] -->
		
<!-- [[ php ]] -->
<!-- [[ header ]] -->
        <div id="header"><div id="header-inner">
            
            <p id="logo"><img src="common/images/header_id.gif" alt="Nazo Corporaiton" /></p>
            <ul id="globalNavigation">
                <li><a href="#">連絡我們</a></li>
                <li><a href="login.html">會員登入</a></li>
				<li><a href="head.html">回首頁</a></li>
                <input type="search" name="search" id="search">
                <li><a href="#"><img src="common/images/whitet.png" alt="搜尋" /></a></li>
            </ul>
            
        </div></div>
<!-- [[ /header ]] -->
<!-- [[ list ]] -->
       <div id="global_navi"><div id="global_navi-inner">
            <ul>
                <li><a href="#">活動資訊</a>

                    <ul class="pd">
                        <li><a href="#">最新活動</a></li>
                        <li><a href="#">熱門活動</a></li>
                        <li><a href="#">主線活動</a></li>
                        <li><a href="#">支線活動</a></li>
                        <li><a href="#">限時活動</a></li>
                    </ul>
                </li>
                <li><a href="#">會員專區</a></li>
                <li><a href="#">相關問題</a></li>
            </ul>
       </div></div>

<!-- [[ /list ]] -->
<!-- [[ contents]] -->
		<div id="contents"><div id="contents-inner">
				<div id="active-head"> 
					<input class="button-on"  type="submit"  value="最新活動" id="sub_1"  onclick="changeColor('1')">
					<input class="button-off" type="submit"  value="熱門活動" id="sub_2"  onclick="changeColor('2')"/>
					<input class="button-off" type="submit"  value="主線活動" id="sub_3"  onclick="changeColor('3')"/>
					<input class="button-off" type="submit"  value="支線活動" id="sub_4"  onclick="changeColor('4')"/>
					<input class="button-off" type="submit"  value="限時活動" id="sub_5"  onclick="changeColor('5')"/>
				</div>

				<div id="task">
					<div id="task-content">
						<div id="task-h1">	
							<h1>臺中市文化資產是臺中市文化資產處與文化資</h1><br>
						</div>
						<div id="task-time">	
							<p>台中市&nbsp;&nbsp;&nbsp;&nbsp; 2016/10/16</p><br>
						</div>
						<div id="task-inner">
							<img src="http://www.ebizlearning.com.my/web/picture/2/2/main.jpg">
							<p>臺中市文化資產是臺中市文化資產處與文化部文化資產局依《文化資產保存法》裡的七類文化資產以及文化資產保存技術及保存者將臺中市市域內登錄的文化資產。臺中地區開發史從清治時期開始至今已有一百多年的歷史，經歷了清朝、日治與民國時期。臺中市文化資產是臺中市文化資產處與文化部文化資產局依《文化資產保存法》裡的七類文化資產以及文化資產保存技術及保存者將臺中市市域內登錄的文化資產。臺中地區開發史從清治時期開始至今已有一百多年的歷史，經歷了清朝、日治與民國時期。</p><br>
						</div>
					</div>
				</div>
				
				<div id='story-list'>
					<div id='story'><div id="story-inner">
					<img src="http://www.ebizlearning.com.my/web/picture/2/2/main.jpg">
						<p>臺中市文化資產是臺中臺中中市文化資產是臺中臺</p>
						<p>臺中市文化資產是臺中市文化資產處與文化部</p>
					</div></div>
	
				</div>
				
				
				
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
                <li><a href="#">活動訊息</a></li>
                <li><a href="#">會員專區</a></li>
                <li><a href="#">常見問題</a></li>
				<li><a href="head.html">回首頁</a></li>
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