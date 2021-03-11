<?php 
include "../header.php";
include "./sub_img.php";
include "./sub_menu.php";
include "../login/dbconn.php";

$page = $_GET[page];
$sql = "select * from greet where num='".$_GET[num]."'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);

$item_id = $row[id];
$item_nick = $row[nick];
$item_hit = $row[hit];
$item_date = $row[regist_day];
$item_date = substr($item_date,0,10);
$item_content = $row[content];
$item_subject = str_replace(" ","&nbsp;",$row[subject]);
$item_num = $row[num];
$item_filename = $row[file_name];
$new_hit = $item_hit + 1;

$sql = "update greet set hit=$new_hit where num=$item_num";
mysqli_query($connect, $sql);
?>

<script>
  function del(href){
    if(confirm("정말 삭제하시겠습니까?"))
      document.location.href=href;
  }
</script>

<article>
<h1>Notice</h1>
<div id="col2">
  <div id="view_title">
    <div id="view_title1"><?=$item_subject?></div>
    <div id="view_title2"><?=$item_nick?> | 조회 : <?=$item_hit?> | <?=$item_date?></div>
  </div>
  <div id="view_content">
    <?=nl2br($item_content)?>
  </div>

  <div id="view_file">
    <?php if($item_filename){?>
      <a href="download.php?file=<?=$item_filename?>">첨부파일 : <?= $item_filename?></a><?php }?>
  </div>
  <div class="clear"></div>

  <div id="view_button">
    <a href="./list.php?page=<?=$page?>"><img src="/basic/images/list.png"></a>&nbsp;
    <?php
      if($_SESSION['userid']&&($_SESSION['userid']==$item_id)){
           ?>
      <a href="./write_form.php?mode=modify&num=<?=$item_num?>&page=<?=$page?>"><img src="/basic/images/modify.png"></a>&nbsp;
      <a href="javascript:del('./delete.php?num=<?=$item_num?>')"><img src="/basic/images/delete.png"></a>&nbsp;
    <?php }if($_SESSION['userid']){?>
      <a href="./write_form.php"><img src="/basic/images/write.png"></a>&nbsp;
    <?php }?>
  </div>
</div>
</article>

<?php
  mysqli_close();
  include "../footer.php";
?>















