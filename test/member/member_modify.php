<? include "../header.php";?>
<? include "sub_img.php";?>
<? include "sub_menu.php";?>

<article>
<h1>Change Your Information</h1>
<form id="join" method="get" action="./modify.php">
<fieldset>
  <legend>Basic Info</legend>
  <label>User ID</label>
  <font size="2" face="verdana" style="line-height:28px;">&nbsp;<?=$_SESSION['userid']?></font>
  <div class="clear"></div>
  <label>Old Password</label>
  <input name="passwd_old" type="password" class="pass">
  <div class="clear"></div>
  <label>New Password</label>
  <input name="passwd" type="password" class="pass">
  <div class="clear"></div>
  <label>Confirm Password</label>
  <input name="pass_confirm" type="password" class="pass">
  <div class="clear"></div>
  <label>Name</label>
  <input name="name" type="text" class="nick" value="<?=$_SESSION['username']?>">
  <div class="clear"></div>
  <label>Nickname</label>
  <input name="nick" type="text" class="nick" value="<?=$_SESSION['usernick']?>">
  <div class="clear"></div>
  <label>Mobile Phone Number</label>
  <input name="hp" type="tel" class="mobile" value="<?=$_SESSION['hp']?>">
  <div class="clear"></div>
  <label>E-Mail</label>
  <input name="e-mail" type="email" class="email" value="<?=$_SESSION['e-mail']?>">
  <div class="clear"></div>
</fieldset>
<div id="buttons">
  <input type="submit" value="Submit" class="submit">
  <input type="button" value="Cancel" class="cancel" onClick="javascript:location.href='../index.php';">
</div>
</form>
</article>

<? include "../footer.php";?>

















