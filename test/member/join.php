<? include "../header.php";?>
<? include "sub_img.php";?>
<? include "sub_menu.php";?>

<article>
<h1>Join Us</h1>
<form id="join" method="get" action="./member_insert.php">
<input type="radio" name="chk_info" value="member" checked >개인
<input type="radio" name="chk_info" value="company">기업
<fieldset>
  <legend>Basic Info</legend>
  <label>User ID</label>
  <input name="id" type="text" class="id">
  <div class="clear"></div>
  <label>Password</label>
  <input name="passwd" type="password" class="pass">
  <div class="clear"></div>
  <label>Confirm Password</label>
  <input name="pass_confirm" type="password" class="pass">
  <div class="clear"></div>
  <label>Name</label>
  <input name="name" type="text" class="nick">
  <div class="clear"></div>
  <label>Nickname</label>
  <input name="nick" type="text" class="nick">
  <div class="clear"></div>
  <label>Mobile Phone Number</label>
  <input name="hp" type="text" class="mobile">
  <div class="clear"></div>
  <label>E-Mail</label>
  <input name="e-mail" type="email" class="email">
  <div class="clear"></div>
</fieldset>
  <div id="buttons">
    <input type="submit" value="Submit" class="submit">
    <input type="button" value="Cancel" class="cancel" onClick="javascript:location.href='../index.php';">
  </div>
</form>
</article>

<? include "../footer.php";?>



















