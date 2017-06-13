<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
  
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.htm	*/
  if ($passed != "TRUE")
  {
    header("location:login.php");
    exit();
  }
  //如果 cookie 中的 passed 變數等於 TRUE
  //表示已經登入網站，取得使用者資料
  else
  {
    require_once("dbtools.inc.php");

    $user_id = $_COOKIE["user_id"];
	$task_number = $_POST["task_number"];

    $link = create_connection();

    //使用者資料
    $sql = "SELECT *,task_introduction FROM task WHERE task_developer = '$user_id' and task_number = 3";
    $result = execute_sql($link, "ebizlearn_th", $sql);

    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
    
        <title>高級會員->修改任務</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/newtask.css" />
		
		
    <script type="text/javascript">
        
        //新增故事
        $sub_num = <?php echo $row['task_part']?>;
        function more(){    
          if($sub_num<10){
              
            $sub_num = $sub_num + 1; 
            
			//新增區塊要在的地方
            var obj = document.getElementById('story-list');
            
			//新增區塊
            var story_div = document.createElement('div');
            var story_tool_div = document.createElement('div');
            var story_content_div=document.createElement('div');
            var story_picture_div=document.createElement('div');
            var story_inner_div=document.createElement('div');
            var story_name_div=document.createElement('div');
            var story_block_div=document.createElement('div');
            var story_URL_div=document.createElement('div');
			
			//區塊ID
            story_div.id='story';
            story_tool_div.id='story-tool';
            story_content_div.id='story-content';
            story_picture_div.className='story-picture';
			story_picture_div.id='story-show-picture'+$sub_num;
            story_inner_div.id='story-inner';
            story_name_div.id='story-name';
            story_block_div.id='story-block';
            story_URL_div.id='story-URL';
            
			//區塊排法
            obj.appendChild(story_div);
            story_div.appendChild(story_tool_div);
            story_div.appendChild(story_content_div);
            story_content_div.appendChild(story_picture_div);
            story_content_div.appendChild(story_inner_div);
            story_inner_div.appendChild(story_name_div);
            story_inner_div.appendChild(story_block_div);
            story_inner_div.appendChild(story_URL_div);
			
			//故事圖片
			var input_picture=document.createElement('p');
			input_picture.innerHTML='您尚未選擇圖片!';
			story_picture_div.appendChild(input_picture);
			
			//故事名稱
			var input_name=document.createElement('input');
			input_name.type='text';
			input_name.name='story_name[]';
			input_name.placeholder='故事名稱(請在20字以內)';
			story_name_div.appendChild(input_name);
			
			//故事地址
			var input_address=document.createElement('input');
			input_address.type='text';
			input_address.name='story_address[]';
			input_address.placeholder='故事地址(EX:台中市西屯區文華路100號)';
			story_block_div.appendChild(input_address);
			
			//故事URL
			var input_URL=document.createElement('input');
			input_URL.type='file';
			input_URL.name='story_picture[]';
			input_URL.id='show_story'+$sub_num;
			story_URL_div.appendChild(input_URL);
			
			//故事內容
			var input_data=document.createElement('TEXTAREA');
			input_data.name='story_data[]';
			input_data.placeholder='故事內容';
			story_inner_div.appendChild(input_data);
            
            
          }else{  
			alert("故事最多10個!");
		  }
        ////
            document.getElementById('show_story2').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture2').innerHTML='';
                        document.getElementById('story-show-picture2').appendChild(img)
                                        
                    }
            })
          ////
            document.getElementById('show_story3').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture3').innerHTML='';
                        document.getElementById('story-show-picture3').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story4').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture4').innerHTML='';
                        document.getElementById('story-show-picture4').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story5').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture5').innerHTML='';
                        document.getElementById('story-show-picture5').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story6').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture6').innerHTML='';
                        document.getElementById('story-show-picture6').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story7').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture7').innerHTML='';
                        document.getElementById('story-show-picture7').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story8').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture8').innerHTML='';
                        document.getElementById('story-show-picture8').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story8').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture8').innerHTML='';
                        document.getElementById('story-show-picture8').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story9').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture9').innerHTML='';
                        document.getElementById('story-show-picture9').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story10').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture10').innerHTML='';
                        document.getElementById('story-show-picture10').appendChild(img)
                                        
                    }
            })
          /////
          /////
          
        }
       
       
      //確認活動資料
      function check_data()
      {
        if (document.myForm.task_name.value.length == 0)
        {
          alert("「活動名稱」未填寫!");
          return false;
        }
        if (document.myForm.task_block.value.length == 0)
        {
          alert("「活動區域」未填寫!");
          return false;
        }
        if (document.myForm.task_picture.value.length == 0)
        {
          alert("「活動圖片」未填寫!");
          return false;
        }        
        if (document.myForm.task_introduction.value.length == 0)
        {
          alert("「活動介紹」未填寫!");
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
					<p class="button-on" style="margin:0 auto;">新增活動內容</p>
			</div>
            
            <form action="addtask.php" method="post"  name="myForm" enctype="multipart/form-data">
            
               <!--新增活動--> 
                
                <div id="active">
                    <div id="active-picture">
                        <img src ="<?php echo $row{"task_picture"} ?>">
                    </div>
                    <div id="active-inner">
                        <div id="task-name">
                            <input type="text" name="task_name" value="<?php echo $row{"task_name"} ?>">
						</div>
                       <?php 
                        echo    "<select name='task_type'>";
                                
                                if($row{"task_type"} == 1){
                        echo        "<option value='1' SELECTED>主線活動</option>";
                        echo        "<option value='2'>支線活動</option>";
                        echo        "<option value='3'>限時活動</option>";
                                }
                                if($row{"task_type"} == 2){
                        echo        "<option value='1'>主線活動</option>";
                        echo        "<option value='2' SELECTED>支線活動</option>";
                        echo        "<option value='3'>限時活動</option>";
                                }
                                if($row{"task_type"} == 3){
                        echo        "<option value='1'>主線活動</option>";
                        echo        "<option value='2'>支線活動</option>";
                        echo        "<option value='3' SELECTED>限時活動</option>";
                                }
                        echo    "</select><br>";
                        ?>
                        <div id="task-block">
                            <input type="text" name="task_block" value="<?php echo $row{"task_block"} ?>">
                        </div>
                        <div id="task-URL">
                            <input type="file" name="task_picture" id="show_task" value="<?php echo $row{"task_picture"} ?>"><br>
						</div>
                        <textarea name="task_introduction" value="<?php echo $row{"task_introduction"} ?>" ><?php echo $row{"task_introduction"} ?></textarea>
                    </div>
                </div>
                
                <!--分段-->
               
                <div id="task-story">
                    <div id="task-story-left">新增故事</div>
                    <div id="task-story-right"></div>
                </div>
                
                <!--新增故事-->
                <div id="story-list">
                    <?php
                        $j=1;
                        $story = "SELECT *,task_introduction FROM task,story WHERE task_developer = '$user_id' and task_number=3 and task_number=story_number";
                        $story_result = execute_sql($link, "ebizlearn_th", $story);
                        
                        while ($story_row = mysqli_fetch_array($story_result) and $j <= $row['task_part']){
                            
                        echo"<div id='story'>";
                        echo    "<div id='story-tool'></div>";
                        echo    "<div id='story-content'>";
                        echo        "<div class='story-picture' id='story-show-picture$j'>";
                        echo            "<img src ='$story_row[story_picture]'>";
                        echo        "</div>";
                        echo        "<div id='story-inner'>";
                        echo            "<div id='story-name'>";
                        echo                "<input type='hidden' name='story_id[]' value='$story_row[story_serial_number]'>";
                        echo                "<input type='text' name='story_name[]' value='$story_row[story_name]'>";
                        echo            "</div>";
                        echo            "<div id='story-block'>";
                        echo                "<input type='text' name='story_address[]' value='$story_row[story_address]'>";
                        echo            "</div>";
                        echo            "<div id='story-URL'>";
                        echo                "<input type='file' name='story_picture[]' id='show_story$j' value='$story_row[story_picture]'>";
                        echo            "</div>";
                        echo            "<textarea name='story_data[]'>$story_row[story_data]</textarea>";
                        echo        "</div>";
                        echo    "</div>";
                        echo"</div>";   
                        
                            $j++;
                        }
                        
                        
                    ?>
                </div>    
                
                <!--活動功能列-->
                <div id="active-bar">
                    <input type="button" value="送出活動" onClick="check_data()"/>
                    <input type="button" value="新增故事" onclick="more();"/>
                    <input type="reset"  value="重新填寫">
                </div>       
                

            </form>
            <!--前端 顯示圖片-->
            <script type="text/javascript">
                document.getElementById('show_task').addEventListener('change',function(){

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
                
                document.getElementById('show_story1').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture1').innerHTML='';
                        document.getElementById('story-show-picture1').appendChild(img)
                                        
                    }
                })
                ////
            document.getElementById('show_story2').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture2').innerHTML='';
                        document.getElementById('story-show-picture2').appendChild(img)
                                        
                    }
            })
          ////
            document.getElementById('show_story3').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture3').innerHTML='';
                        document.getElementById('story-show-picture3').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story4').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture4').innerHTML='';
                        document.getElementById('story-show-picture4').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story5').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture5').innerHTML='';
                        document.getElementById('story-show-picture5').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story6').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture6').innerHTML='';
                        document.getElementById('story-show-picture6').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story7').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture7').innerHTML='';
                        document.getElementById('story-show-picture7').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story8').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture8').innerHTML='';
                        document.getElementById('story-show-picture8').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story8').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture8').innerHTML='';
                        document.getElementById('story-show-picture8').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story9').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture9').innerHTML='';
                        document.getElementById('story-show-picture9').appendChild(img)
                                        
                    }
            })
          /////
          document.getElementById('show_story10').addEventListener('change',function(){

                    var ofile=this.files;
                    var img=new Image();
                    var oFileReader=new FileReader();
                    
                    oFileReader.readAsDataURL(ofile[0])
                    oFileReader.onload=function(){
                        
                        img.src=this.result;
                                        
                        document.getElementById('story-show-picture10').innerHTML='';
                        document.getElementById('story-show-picture10').appendChild(img)
                                        
                    }
            })
          /////
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
  }
?>