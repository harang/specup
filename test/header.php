<? session_start();?>
<html>
<head>
	<link href="/var/www/html/test/css/main.css" rel="stylesheet" type="text/css">
	<link href="/var/www/html/test/css/submain.css" rel="stylesheet" type="text/css">

</head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #33A5FF;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #05599B;
}

</style>

	<div>
		<header>			
		
			<nav id="menu"><ul>
			<li><a class="link" href="../index.php"><img src="/var/www/html/test/specUp.png" alt="logo" height="100"/></a>		</li>
		
				<li><a class='link' href="../contest/list_all.php">참여현황</a></li>
				<li><a class='link' href="../greet/list.php">커뮤니티</a></li>
                <li><a class='link' href="../dynamoDBtest/scan.php">공모전</a></li> 

				<?php 
							if(! $_SESSION['userid'])
							{
								?>
								<li class="link"><a href="../login/login_form.php">개인 로그인</a></li>
								<li class="link"><a href="../member/join.php">개인 회원가입</a></li>
								
						<?php 
							} else {
						?>
							<li class="link"> <a href="../login/logout.php">로그아웃</a></li>
							<li class="link"> <a href="../member/member_modify.php">회원 정보 수정</a></li>
				<?php } ?>				
				 
			</ul></nav>
		</header>
</div>
		<div class="clear"></div>

		
	
		
