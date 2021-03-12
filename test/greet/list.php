<?php	
include "../header2.php";
include "../login/dbconn.php";
	
$scale = 5;
$page = $_GET[page];
$search = $_POST['search'];
$find = $_POST['find'];
$mode = $_GET['mode'];
	
if($mode == "search"){
  if(!$search){echo("<script>window.alert('검색 단어를 입력하세요!');history.go(-1);</script>");exit;}
  $sql = "select * from greet where $find like '%$search%' order by num desc";}
else{$sql = "select * from greet order by num desc";}
	
$result = mysqli_query($connect, $sql);
$total_record = mysqli_num_rows($result);
mysqli_close();
	
if($total_record % $scale == 0){
  $total_page = ($total_record / $scale);
}else{$total_page = floor($total_record / $scale)+1;}
	
if(! $_GET[page]){$page = 1;}
else{$page = $_GET[page];}
	
$start = ($page - 1) * $scale;
$number = $total_record - $start;
	
include "sub_img.php";
include "sub_menu.php";
?>
<article>
  <h1> Notice </h1>
  <table id = "notice">
  <tr><th class="tno">No.</th>
    <th class="ttitle">Title</th>
    <th class="twriter">Writer</th>
    <th class="tdata">Date</th>
    <th class="tread">Read</th></tr>
<?php 
  for($i=$start; $i < $start+$scale && $i < $total_record ;$i++){
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
		
    $item_num = $row[num];
    $item_nick = $row[nick];
    $item_hit = $row[hit];
    $item_date = $row[regist_day];
    $item_date = substr($item_date, 0, 10);
    $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
?>
  <tr><td><?= $number ?></td>
    <td class="left"><a href="view.php?num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a></td>
    <td><?= $item_nick ?></td>
    <td><?= $item_date ?></td>
    <td><?= $item_hit ?></td></tr>

<?php $number--;}?>
  </table>

<form name="board_from" method="post" action="./list.php?mode=search">
  <div id="table_search">
    <select name="find">
      <option value='subject'>제목</option>
      <option value='content'>본문</option>
      <option value='nick'>닉네임</option>
    </select>
    <input type="text" name="search" class="input_box">
    <input type="submit" value="submit" class="btn">
  </div>
</form>
		
<div class="clear"></div>
<div id="page_control">
  <a href="./list.php?page=<?php if($page==1){echo $page;}else{echo $page-1;}?>">Prev</a> 
<?php for ($i=1; $i <= $total_page; $i++)
{if ($page == $i){echo "<b> $i </b>";}
  else{echo "<a href='list.php?page=$i'> $i </a>";}
}?>
<a href="./list.php?page=<?php if($page==$total_page){echo $page;}else{echo $page+1;}?>">Next</a> 

  <div id="button">
    <?php if($_SESSION['userid']){?>
    <a href="write_form.php"><img src="/basic/images/write.png"></a>&nbsp;
    <?php }?>
  </div>
</div>
</article>
	
<?php
mysqli_close();
include "../footer.php"
?>
