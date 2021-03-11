<?php
	//session_start();
  include "../header.php"; 
  ?>
<div id="sub_img_login">
</div>

<article id="login_art">
	<h1>Login</h1>
	
	<div class="login_box">
		<form name="login_form" method="get" action="login.php">
			<label>아이디</label>
				<input type="text" name="userid">
				<div class="clear"></div>
			<label>패스워드</label>
				<input type="password" name="passwd">
								<div class="clear"></div>
				<span class="btn"><input type="submit" value="로그인하기"></span>
		</form>
	</div>
</article>
<?php include "../footer.php";?>
