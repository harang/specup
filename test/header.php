<? session_start();?>
<html>
<head>
	<link href="/basic/css/main.css" rel="stylesheet" type="text/css">
	<link href="/basic/css/submain.css" rel="stylesheet" type="text/css">

</head>
	<div id="wrap">
		<header>			
			<div id="logo">
			<a class="navbar-brand" href="../index.php"><img src="specUp.png" alt="logo" height="100"/></a>		
			</div>
		
			<nav><ul>
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
				 
			</ul></nav>
		</header>
		<div class="clear"></div>
		
	
		
