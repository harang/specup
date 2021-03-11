<? session_start();?>
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


<!--	<div id="wrapper">-->
<div id="wrap">
	<header>
	<div class="clear"></div>




		<div class="navbar navbar-default navbar-static-top">
        	<div class="container">
				<div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php"><img src="specUp.png" alt="logo" height="100"/></a>					
        		</div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">                        
						<li><a href="../contest/list.php">참여현황</a></li>
						<li><a href="../greet/list.php">커뮤니티</a></li>
                        <li><a href="../company/welcome.php">콘텐츠</a></li>
                        <li><a href="../dynamoDBtest/scan.php">공모전</a></li>                      

						<?php 
							if(! $_SESSION['userid'])
							{
								?>
								<li class="active"><a href="../login/login_form.php">개인 로그인</a></li>
								| <li class="active"><a href="../member/join.php">개인 회원가입</a></li>
								
						<?php 
							} else {
						?>
							<li class="active"> <a href="../login/logout.php">로그아웃</a></li>
							|<li class="active"> <a href="../member/member_modify.php">회원 정보 수정</a></li>
						<?php } ?>

                    </ul>
                </div>
			</div>
		</div>

		</header>

	<div class="clear"></div>
	
