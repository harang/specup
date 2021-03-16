<? include "../header.php";?>
<? include "sub_img.php";?>
<? include "sub_menu.php";?>

<article>
<h1>회원정보 수정</h1>
<form id="join" method="get" action="./modify.php">
<fieldset>
  <legend>기본정보</legend>
  <label>아이디</label>
  <font size="2" face="verdana" style="line-height:28px;">&nbsp;<?=$_SESSION['userid']?></font>
  <div class="clear"></div>
  <label>현재 비밀번호</label>
  <input name="passwd_old" type="password" class="pass">
  <div class="clear"></div>
  <label>새 비밀번호</label>
  <input name="passwd" type="password" class="pass">
  <div class="clear"></div>
  <label>새 비밀번호 확인</label>
  <input name="pass_confirm" type="password" class="pass">
  <div class="clear"></div>
  <label>이름</label>
  <input name="name" type="text" class="nick" value="<?=$_SESSION['username']?>">
  <div class="clear"></div>
  <label>닉네임</label>
  <input name="nick" type="text" class="nick" value="<?=$_SESSION['usernick']?>">
  <div class="clear"></div>
  <label>휴대전화/label>
  <input name="hp" type="tel" class="mobile" value="<?=$_SESSION['hp']?>">
  <div class="clear"></div>
  <label>E-Mail</label>
  <input name="e-mail" type="email" class="email" value="<?=$_SESSION['e-mail']?>">
  <div class="clear"></div>
</fieldset>
<div id="buttons">
  <input type="submit" value="수정하기" class="submit">
  <input type="button" value="취소" class="cancel" onClick="javascript:location.href='../index.php';">
</div>
</form>
</article>

<? include "../footer.php";?>

















