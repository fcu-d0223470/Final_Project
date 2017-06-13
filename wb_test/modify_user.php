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

    $link = create_connection();

    //使用者資料
    $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = execute_sql($link, "ebizlearn_th", $sql);

    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
    
        <title>會員註冊</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/join.css" />
		
		
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.account.value.length == 0)
        {
          alert("「使用者帳號」未填寫!");
          return false;
        }
        if (document.myForm.account.value.length > 20 || document.myForm.account.value.length <= 5)
        {
          alert("「使用者帳號」請勿小於6或大於20個字!");
          return false;
        }
        if (document.myForm.password.value.length == 0)
        {
          alert("「使用者密碼」未填寫!");
          return false;
        }
        if (document.myForm.password.value.length > 20 || document.myForm.password.value.length <= 5)
        {
          alert("「使用者密碼」請勿小於6或大於20個字!");
          return false;
        }
        if (document.myForm.re_password.value.length == 0)
        {
          alert("「密碼確認」未填寫!");
          return false;
        }
        if (document.myForm.password.value != document.myForm.re_password.value)
        {
          alert("「密碼確認」錯誤!!! 請檢查密碼!!!");
          return false;
        }
        if (document.myForm.fname.value.length == 0)
        {
          alert("您的姓氏未填寫！");
          return false;
        }
        if (document.myForm.lname.value.length == 0)
        {
          alert("您的名字未填寫！");
          return false;
        }
        if (document.myForm.cellphone.value.length == 0)
        {
          alert("您的行動電話未填寫！");
          return false;
        }
        if (document.myForm.email.value.length == 0)
        {
          alert("您的E-mail未填寫！");
          return false;
        }
        myForm.submit();
      }
	  
	  <!--防重複提交
	  JavaScript:window.history.forward(1);
	  
	  -->
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
		<div id="contents">
			<div id="login">
				
				
				<div id="person">
					<form action="update_user.php" method="POST"  name="myForm">
						<input type="text" 			name="fname" 		value="<?php echo $row{"user_fname"} ?>" style="width:140px; float:left;">
						<input type="text" 		    name="lname"  		value="<?php echo $row{"user_lname"} ?>" style="width:140px; float:right;"><br>
						<input type="text" 			name="account"  	value="<?php echo $row{"user_account"} ?>"><br>
						<input type="password" 		name="password" 	value="<?php echo $row{"user_password"} ?>"><br>
						<input type="password" 		name="re_password" 	value="<?php echo $row{"user_password"} ?>"><br>
						<?php 
                        echo    "<select name='sex'>";    
                                if($row{"user_sex"} == '男'){
                        echo        "<option value='男' SELECTED>男</option>";
						echo    	"<option value='女'>女</option>";
                                }
                                if($row{"user_sex"} == '女'){
                        echo        "<option value='男'>男</option>";
						echo    	"<option value='女' SELECTED>女</option>";
                                }
                        echo    "</select><br>";
                        ?>
                        <input type="text" 			name="cellphone" 	value="<?php echo $row{"user_cellphone"} ?>"><br>
						<input type="text"			name="telephone"  	value="<?php echo $row{"user_telephone"} ?>"><br>
						<input type="text" 			name="email" 		value="<?php echo $row{"user_email"} ?>"><br>
						<input type="text" 			name="address" 		value="<?php echo $row{"user_address"} ?>"><br>
						<input type="text" 			name="url" 			value="<?php echo $row{"user_url"} ?>"><br>
						<input type="button" 		value="修改" 		onClick="check_data()">   
											　 
					</form>
				</div>
				
			</div>
        </div>
  
<!-- [[ /contents ]] --> 
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