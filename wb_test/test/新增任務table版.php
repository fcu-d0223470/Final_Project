<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
  
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.htm	*/
  if ($passed != "TRUE")
  {
    header("location:head.php");
    exit();
  }
?>
<!DOCTYPE> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
    
        <title>高級會員->新增任務</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/newtask.css" />
		
		
    <script type="text/javascript">
        
        //新增故事
        $sub_num = 1;
        function more(){    
          if($sub_num<10){
            $sub_num = $sub_num + 1; 
            
            nt = document.getElementById('myTable').insertRow(document.getElementById('myTable').rows.length-1) 
 
            story_name = nt.insertCell(0); 
            story_address = nt.insertCell(1);
            story_picture = nt.insertCell(2);
            story_data = nt.insertCell(3);
            
            story_name.innerHTML = "<input type='text' name='story_name[]' >"; 
            story_address.innerHTML = "<input type='text' name='story_address[]' >";
            story_picture.innerHTML = "<input type='file' name='story_picture[]' >";
            story_data.innerHTML = "<input type='text' name='story_data[]' >";         
          }           
        }
       
       
      //確認活動資料
      function check_data()
      {
        if (document.myForm.task_name.value.length == 0)
        {
          alert("「任務名稱」未填寫!");
          return false;
        }
        if (document.myForm.task_block.value.length == 0)
        {
          alert("「任務區域」未填寫!");
          return false;
        }
        if (document.myForm.task_type.value.length == 0)
        {
          alert("「任務型態」未填寫!");
          return false;
        }
        if (document.myForm.task_picture.value.length == 0)
        {
          alert("「任務圖片」未填寫!");
          return false;
        }
        if (document.myForm.task_introduction.value.length == 0)
        {
          alert("「任務介紹」未填寫!");
          return false;
        }           
        myForm.submit();
      }

      
    </script> 
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
                        <li><a href="active_hot.php">高級會員</a></li>
                    </ul>
                </li>
                <li><a href="#">相關問題</a></li>
            </ul>
       </div></div>

<!-- [[ /list ]] -->
<!-- [[ contents]] -->
		<div id="contents"><div id="contents-inner">
			<div id="active-head" style="background:#FF7100;"> 
					<p class="button-on" style="margin:0 auto;">新增活動內容</p>
			</div>
            
            <form action="addtask.php" method="POST"  name="myForm">
            
               <!--新增活動--> 
                
                <div id="active">
                    <div id="active-picture">
                        <p>您尚未選擇圖片!</p>
                    </div>
                    <div id="active-inner">
                        <div id="task_name">
                            <input type="text" name="task_name" placeholder="*活動名稱(請在20字以內)">
						</div>
                        <select name="sex">
                            <option value="1">主線活動</option>
                            <option value="2">支線活動</option>
                            <option value="3">限時活動</option>
                        </select><br>
                        <div id="task_block">
                            <input type="text" name="task_block" placeholder="*活動區域(EX:台中市西屯區)">
                        </div>
                        <div id="task_URL">
                            <input type="file" name="task_picture" id="task_picture"><br>
						</div>
                        <textarea name="task_introduction" placeholder="*任務介紹"></textarea>
                    </div>
                </div>
                
                <!--分段-->
               
                <div id="task-story">
                    <div id="task-story-left">新增故事</div>
                    <div id="task-story-right"></div>
                </div>
                
                <!--新增故事-->
            <table id="myTable"> 
                <div id="story">
                    <div id="story-tool">
                        <div id="story-tool-off">
                            <input name='Submit1'		type='submit' value='下架'/>
                        </div>
                    </div>
                    
                    <div id="story-content">

                        <div class="story-picture" id="story-show-picture1">
                            <p>您尚未選擇圖片!</p>
                        </div>
                        
                        <div id="story-inner">
                            <div id="story_name">
                                <input type="text" name="story_name[]" placeholder="*故事名稱(請在20字以內)">
                            </div>
                            <div id="story_block">
                                <input type="text" name="story_address[]" placeholder="*故事地址(EX:台中市西屯區文華路100號)">
                            </div>
                            <div id="story_URL">
                                <input type="file" name="story_picture[]" id="story_picture1"><br>
                            </div>
                            <textarea name="story_data[]" placeholder="*任務介紹"></textarea>
                        </div>  
                    </div>
                </div>
              
            </table>    
                
                <!--活動功能列-->
                <div id="active-bar">
                    <input type="button" value="送出活動" onClick="check_data()"/>
                    <input type="button" value="新增故事" onclick="more();"/>
                    <input type="reset"  value="重新填寫">
                </div>       
                

            </form>
            <!--前端 顯示圖片-->
            <script type="text/javascript">
                document.getElementById('task_picture').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('active-picture').innerHTML='';
                        document.getElementById('active-picture').appendChild(img)
                                        
                    }
                })   
                

                document.getElementById('story_picture'+i).addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture'+i).innerHTML='';
                        document.getElementById('story-show-picture'+i).appendChild(img)
                                        
                    }
                })  
            
            </script> 
            
            
            
            
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
		<div class="cle"></div>
        <div id="footer"><div id="footer-inner">
            
            <ul id="siteinfoNavigation">
                <li><a href="active_new.php">活動資訊</a></li>
                <li><a href="#">會員專區</a></li>
                <li><a href="#">常見問題</a></li>
				<li><a href="head.php">回首頁</a></li>
            </ul>
            <address>郭子奇股份有限公司  版權所有  電話 : 0936782861<br>
            地址 : 台中市西屯區逢甲大學育樂館2樓</address>
            
        </div></div>
<!-- [[ /footer ]] -->

  </body>
</html>