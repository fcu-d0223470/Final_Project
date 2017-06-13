<!DOCTYPE> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
    
        <title>旅遊尋寶</title>
        
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="common/styles/head.css" />
             
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
        
            <div class="slideshow-container">
				<div class="mySlides fade">
					<div class="numbertext">1 / 3</div>
					<img src="common/images/img1.jpg" style="width:100%">
					<div class="text">Caption Text</div>
				</div>
				<div class="mySlides fade">
					<div class="numbertext">2 / 3</div>
					<img src="common/images/img2.jpg" style="width:100%">
					<div class="text">Caption Two</div>
				</div>
				<div class="mySlides fade">
					<div class="numbertext">3 / 3</div>
					<img src="common/images/img3.jpg" style="width:100%">
					<div class="text">Caption Three</div>
				</div>
			</div>
			
			<br>

			<div id="dot-space" style="text-align:center">
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
			</div>
			
			<div id="introduction">
				<div class="title">
					<h1>Travel Hunt Company Information</h1>
				</div>
				<div id="test">
					<img src="common/images/img1.jpg">
					<h2>製作團隊</h2>
					<div id="block">
						<p>Phasellus pellentesque, ante nec iaculis dapibus, eros justo auctor lectus, a lobortis lorem mauris quis nunc. Praesent pellentesque facilisis elit. Class aptent taciti sociosqu ad  torquent per conubia nostra.</p>
					</div>
				</div>
				<div id="test">
					<img src="common/images/img2.jpg">
					<h2>開發動機</h2>
					<div id="block">
						<p>Phasellus pellentesque, ante nec iaculis dapibus, eros justo auctor lectus, a lobortis lorem mauris quis nunc. Praesent pellentesque facilisis elit. Class aptent taciti sociosqu ad  torquent per conubia nostra.</p>
					</div>
				</div>
				<div id="test">
					<img src="common/images/img3.jpg">
					<h2>未來展望</h2>
					<div id="block">
						<p>Phasellus pellentesque, ante nec iaculis dapibus, eros justo auctor lectus, a lobortis lorem mauris quis nunc. Praesent pellentesque facilisis elit. Class aptent taciti sociosqu ad  torquent per conubia nostra.</p>
					</div>
				</div>
			</div>
			
        </div>
<!-- [[ /contents ]] -->
	<script>
	
		var slideIndex = 0;
		showSlides();

		function showSlides() {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
    
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";
			}
			slideIndex++;
    
			if (slideIndex> slides.length) {slideIndex = 1}
			
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";
			dots[slideIndex-1].className += " active";
			setTimeout(showSlides, 3000); // Change image every 2 seconds
		}
		
	</script>
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