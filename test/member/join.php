<? include "../header.php";?>
<? include "sub_img.php";?>

<article>
<h1>회원가입</h1>
<form id="join" method="get" action="./member_insert.php">
<input type="radio" name="chk_info" value="member" checked >개인
<input type="radio" name="chk_info" value="company">기업
<fieldset>
  <legend>정보입력</legend>
  <label>아이디</label>
  <input name="id" type="text" class="id">
  <div class="clear"></div>
  <label>비밀번호</label>
  <input name="passwd" type="password" class="pass">
  <div class="clear"></div>
  <label>비밀번호 재확인</label>
  <input name="pass_confirm" type="password" class="pass">
  <div class="clear"></div>
  <label>이름</label>
  <input name="name" type="text" class="nick">
  <div class="clear"></div>
  <label>닉네임</label>
  <input name="nick" type="text" class="nick">
  <div class="clear"></div>
  <label>휴대전화</label>
  <input name="hp" type="text" class="mobile">
  <div class="clear"></div>
  <label>E-Mail</label>
  <input name="e-mail" type="email" class="email">
  <div class="clear"></div>
</fieldset>
  <div id="buttons">
    <input type="submit" value="가입하기" class="submit">
    <input type="button" value="취소" class="cancel" onClick="javascript:location.href='../index.php';">
  </div>
</form>
</article>




















