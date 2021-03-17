<?php 
	session_start();
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<html>
	<head>

	<meta charset="utf-8">
	<title>당신의 스펙을 Up! Spec Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="" />
	<meta name="author" content="신하랑" />

	<link href="/basic/css/main.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
	<link href="css/jcarousel.css" rel="stylesheet" />
	<link href="css/flexslider.css" rel="stylesheet" />
	<link href="js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" />   
	</head>


	<body>
	
	<div id="wrapper" class="home-page">
		<header>
		<div class="navbar navbar-default navbar-static-top">
            <div class="container">
				<div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/specUp.png" alt="logo" height="100"/></a>					
                </div>
			
		<!--	
		<?php 
		//commented out
			if(! $_SESSION['userid'])
			{
				?>
				<div id="login"><a href="./login/login_form.php">Login</a>
				| <a href="./member/join.php">Join</a>
				</div>
		<?php 
			} else {
		?>
			<div id="login"><a href="./login/logout.php">Logout</a>
				| <a href="./member/member_modify.php">Modify</a>
				</div>
		<?php } ?>
		-->
		
		
		<!--from html-->
			
                

                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        
						<li><a href="./contest/list_all.php">참여현황</a></li>
						<li><a href="./greet/list.php">커뮤니티</a></li>
                        <li><a href="./dynamoDBtest/scan.php">공모전</a></li>                 

						<?php 
							if(! $_SESSION['userid'])
							{
								?>
								<li class="active"><a href="./login/login_form.php">로그인</a></li>
								<li class="active"><a href="./member/join.php">회원가입</a></li>
								
						<?php 
							} else {
						?>
							<li class="active"> <a href="./login/logout.php">로그아웃</a></li>
							<li class="active"> <a href="./member/member_modify.php">회원 정보 수정</a></li>
								
						<?php } ?>

                    </ul>
                </div>
            </div>
        </div>
		</header>
	<!-- end header -->


	<section id="banner">	

		<div id="main-slider" class="flexslider">
			
			<img src="img/slides/1.png" height="600" alt="" />
			<div class="flex-caption">
				<h3>공모전 리스트</h3> 
				<p>공모전 리스트를 보고싶다면 하단의 보러가기 버튼을 클릭해보세요!</p> 
				<a href="dynamoDBtest/scan.php" class="btn btn-theme">보러가기</a>
			</div>
		
		</div>
	</section>							
		
	<section id="content">	
		 <div class="clear"></div>
		 <div class="container">	
		 	<div class="row">
		 		<h3 class="aligncenter">HOT 공모전 TOP 20</h3>
		 		<table>
					<!--<?php
						$urlRoot="http://169.254.169.254/latest/meta-data/";
						echo "<tr><td class='contxt'><b>InstanceId</b></td><td>" . file_get_contents($urlRoot . 'instance-id') . "</td></tr>";
						echo "<tr><td class='contxt'><b>Availability Zone</b></td><td>" . file_get_contents($urlRoot . 'placement/availability-zone') . "</td></tr>";
						//공모전 리스트 가져오기
					?>-->

				<?php
				include "dynamoDBtest/scan2.php"
				?>

		 		</table>
		 	</div>
			</div>
							
    </section>

		<footer>
			<hr>
			
			<div id="copy">
			
			contact mail : godharang@gmail.com Tel: +82 010-1234-1234
			</div>
			<div id="social">
				<img src="images/facebook.gif" width="33" height="33" alt="Facebook">
				<img src="images/twitter.gif" width="33" height="33" alt="twitter">
				
			</div>
		</footer>
	</div><!-- wrap -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script> 
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script src="js/owl-carousel/owl.carousel.js"></script>
</body>
</html>
