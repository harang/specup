<?php include "header.php" ?>
<?php include "sub_img.php";?>
<?php include "sub_menu.php";?>
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<article>
	<h1>Welcome</h1>
	<figure class="ceo">
		<img src="../images/company/1.gif" width="233" height="216" alt="CEO">
		<figcaption>CARE LAB 대표이사 정은지</figcaption></figure>
		<p>저희 회사를 찾아주셔서 감사합니다.<br></p>
		 <p>저희 회사는 웹에 대한 모든 솔루션을 제공하는 회사로써 
		 인터넷에 관한 다양한 솔루션을 제공하고  있습니다.</p>
    <p>이 모두가 저희 회사을 아껴주시고 사랑해 주시는 고객 여러분의   덕택이라고
  생각하며 고객 여러분에 대하여 진심으로 감사 드립니다.</p>
    <p><BR>
    저희 회사는 업체 최고 품질 수준의 책임을 다하기 위하여 고객 여러분이   계시는
      가장 가까운 곳에서 품질, 납기, 원가등 고객분이 원하시는 요구사항에 대해서   언제나 
      신뢰성을 바탕으로 충분한 만족을 드리기 위해 최선을 다하고   있습니다.<BR>
    </p>
    <p>더불어 고정관념을 과감히 탈피하는 좀 더 체계적이고 혁신적인 최고품질의   제품을
      생산코자 2003.12 QS9000 인증 획득, 2005.12 ISO/TS16949   인증획득,      2006.12 ISO14001 인증을 취득하여 고객 만족에 만전을 기하고   있습니다.<BR>
	</p>
    <p>앞으로도 저희 회사는 '품질 고급화'의 품질 방침과 항상 겸허한 자세로 고객   여러분께
    최고의 만족을 드릴 수 있도록 더 열심히 노력하겠습니다. </p>
    <p>고객 여러분의 변함없는 격려와 성원을   부탁드립니다.<BR>
    </p>
	<table style="float:right">
        <?php
                $urlRoot="http://169.254.169.254/latest/meta-data/";
                echo "<tr><td><b>InstanceId</b></td><td style='text-align:right'>" . file_get_contents($urlRoot . 'instance-id') . "</td></tr>";
                echo "<tr><td><b>Availability Zone</b></td><td style='text-align:right'>" . file_get_contents($urlRoot . 'placement/availability-zone') . "</td></tr>";
        ?>
	</table>
</article>


<?php include "../footer.php";?>
