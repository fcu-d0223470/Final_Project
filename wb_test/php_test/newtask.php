<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
  
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.htm	*/
  if ($passed != "TRUE")
  {
    header("location:index.htm");
    exit();
  }
?>
<html>
  <head>
    <title>新增任務</title>
    <script type="text/javascript">
        $sub_num = 1;
        function more(){    
          while($sub_num<10){
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
          break;
          }           
        }
        
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
    <p align="center"><img src="join.jpg"></p>
    
    <form action="addtask_test.php" method="post" name="myForm" enctype="multipart/form-data"> 
      <table width="500"  border="2" colspan="5" cellspacing="1" align="center" bordercolor="#6666FF"> 
        <tr> 
          <td colspan="5" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">請填入下列資料 (標示「*」欄位請務必填寫)</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*任務名稱：</td>
          <td><input type="text" name="task_name" size="20"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*任務區域：</td>
          <td><input type="text" name="task_block" size="20"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*任務型態：</td>
          <td> 
            <input type="radio" name="task_type" value="1" checked>主線 
            <input type="radio" name="task_type" value="2">支線
            <input type="radio" name="task_type" value="3">活動
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*任務圖片：</td>
          <td>
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            <input type="file" name="task_picture" size="100"><br><br>   
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*任務介紹：</td>         
          <td><textarea name="task_introduction" cols="45" rows="4" ></textarea></td>
        </tr>       
      </table> 
      <table id="myTable" table width="500"  border="1" cellpadding="5" cellspacing="1" align="center"> 
        <h1>新增故事紀錄</h1>
        <tr align="center">
            <td>故事名稱</td>
            <td>故事位置</td>
            <td>故事圖片</td>
            <td>故事內容</td>   
        </tr>        
        <tr align="center"> 
            <td><input type="text" name="story_name[]" ></td> 
            <td><input type="text" name="story_address[]" ></td>
            <td><input type="file" name="story_picture[]" ></td>
            <td><input type="text" name="story_data[]" ></td>           
        </tr>        
        <tr align="center">
          <td colspan="6">
            <input type="button" value="送出" onClick="check_data()"/>&nbsp;&nbsp;&nbsp;&nbsp; 
            <input type="button" value="新增更多故事" onclick="more();" />&nbsp;&nbsp;&nbsp;&nbsp; 
            <input type="reset" value="重新填寫">
          </td>
        </tr>       
      </table> 
    </form> 
  </body>
</html>