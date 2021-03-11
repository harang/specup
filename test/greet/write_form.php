<?php
include "../header.php";
include "sub_img.php";
include "sub_menu.php";
?>
<?php 

$mode = $_GET[mode];
$item_num = $_GET[num];
$page = $_GET[page];
$usernick =$_SESSION['usernick'];

if($mode == "modify")
{
	include "../login/dbconn.php";
	$sql = "select * from greet where num=$item_num";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
	$item_subject = $row[subject];
	$item_content = $row[content];
	mysqli_close();
}
?>


<article>
	<h1>글 작성하기</h1>
	<div id="col2">
		
<?php 
	if($mode == "modify")
	{
?>
	
	<form name="board_form" method="post" action="insert.php?mode=modify&num=<?=$item_num?>&page=<?=$page?>" enctype="multipart/form-data">
	<?php 
	}	
	else
	{
?>
		<form name="board_form" method="post" action="insert.php" enctype="multipart/form-data">
<?php 
	}
?>
			<div id="write_form">
				<div class="write_line"></div>
					<div id="write_row1">
						<div class="col1"> 닉네임 </div>
						<div class="col2"> <?=$usernick?></div>
					</div>
				<div class="write_line"></div>
				
					<div id="write_row2">
						<div class="col1"> 제목 </div>
						<div class="col2">
							<input type="text" name="subject" value="<?=$item_subject?>">
						</div>
					</div>
				<div class="write_line"></div>
				
					<div id="write_row3">
						<div class="col1"> 내용 </div>
						<div class="col2">
							<textarea name="content"><?=$item_content?></textarea>
						</div>
					</div>
						<div class="write_line"></div>
						
					<div id="write_row4">
						<div class="col1"> 파일 </div>
						<div class="col2">
							<input type="file" name="upfile">
						</div>
					</div>
					<div class="clear"></div>
			
			</div>
			<div class="write_line"></div>
			<div id="write_button">
				<input type="image" src="/basic/images/ok.png">&nbsp;
				<a href="list.php?page=<?=$page?>"><img src="/basic/images/list.png">	</a>
			</div>
			
			
		</form>
	</div><!-- col2 end -->
</article>

<?php 
	include "../footer.php";
?>
