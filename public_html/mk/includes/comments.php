<?php 
//session_start();?>
<!-- Blog Comments -->

                
      <!-- Posted Comments -->
      <?php
	  $TmpAdminSession=$_SESSION[$TmpAdminSession];
	  if ($_GET["komentar"]==1) {echo "<a name='komentari' id='komentari'></a><h3>Вашиот коментар е успешно внесен.<br>По одобрувањето од администратор, ќе биде јавно објавен.</h3>";}
	  else if ($_GET["komentar"]==2) {echo "<a name='komentari' id='komentari'></a><h3>Вашиот коментар не е внесен заради погрешно внесен код</h3>";}
			$sql_komentari = "Select * from forum WHERE record_id=".$tmpID." order by create_date desc";
			//echo $sql_komentari;
			$result_komentari=mysqli_query($con, $sql_komentari);
			//confirm_query($result_komentari);
				while ($row_komentari = mysqli_fetch_assoc($result_komentari)) {
	//if ($row = mysqli_fetch_assoc($result)) {
		
				$create_date=strftime("%d %b %Y %H:%M", strtotime($row_komentari["create_date"]));
		
		?>
		<div class="media <?php if ($row_komentari["approved"]!=1) {echo " post_marked"; if ($TmpAdminSession != "yes") {echo " post_hidden";}}// else if ($row_komentari["approved"]==0) {echo "post_notapproved";}?>">
        <a class="pull-left"><img class="media-object" src="/images/pix.gif" width="20px" alt=""></a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo($row_komentari["name"]) ?>
                    <small><?php echo $create_date?></small>
                </h4>

		<?php
		echo  stripslashes($row_komentari['post']);
		echo "<div class=\"reply_div\"><div style=\"display: block; clear:both; float:none; overflow:hidden; margin-bottom:10px;\">";
		//if (isset($_SESSION["user"])) {//komentari se dozvoleni samo za logiranite korisnici
			echo "<button type=\"button\" class=\"btn btn-default btn-sm pull-right reply_kopce kopce\" parent=\"".$row_komentari["id"]."\" ><i class=\"fa fa-reply\" aria-hidden=\"true\"></i> одговори</button>";

		//}
		//echo "TmpAdminSession: ".$TmpAdminSession;
		
		if ($TmpAdminSession == "yes") {
			if ($row_komentari["approved"]==1) {
				echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/mk/includes/forum/_approve_post.php?id=".$row_komentari["id"]."\" ><i class=\"fa fa-warning\"></i> Disapprove as administrator</a>";
			} else {
				echo "<a class=\"btn btn-default btn-sm pull-right hide_kopce kopce\" href=\"/mk/includes/forum/_approve_post.php?id=".$row_komentari["id"]."\" ><i class=\"fa fa-check\"></i>  Approve as administrator</a>";
			}
		}
		//echo "<a class=\"btn btn-default btn-sm pull-right approve_kopce kopce\" href=\"/includes/forum/_approve_post.php?id=".$row["id"]."\" >Approve/Disapprove</a>";
		echo "</div><div class=\"comment\"></div></div>";
		//echo "<div><div>"; //mora da gi ima zaradi kodot vo display_children_topic()
		display_children_topic_comments($row_komentari["id"],0);
		//echo("id: ".$row["id"]);
	}//while
		mysqli_free_result($result_komentari);?>
      <!-- Comment -->

                <!-- Comments Form -->
      <div class="">
      <script language="JavaScript">
		<!--
		
		function validacijaContact()
		{
			//alert("validacijaUserPassCh"); return false;
		if (document.getElementById('name').value==''){alert('Полето за име е задолжително!');return false;}
		if (document.getElementById('post').value==''){alert('Полето за коментар е задолжително!');return false;}
		if (document.getElementById('captcha_kod').value!='<?php echo $_SESSION['captcha']['code'] ?>'){alert('Кодовите не се идентични!');return false;}
		document.getElementById("contactform").submit();
		}
		//-->
		</script>
        <h4>Оставете коментар</h4>
        <form id="contactform" role="form" action="includes/forum/_insert_post.php" method="post" enctype="application/x-www-form-urlencoded" onSubmit="return validacijaContact()">
          <div class="form-group">
            <input class="form-control" name="name" id="name" type="text" placeholder="Внесете го вашето име">
          </div>
          <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="Внесете го вашиот коментар" name="post" id="post"></textarea>
            <input name="record_id" id="record_id" type="hidden" value="<?php echo $tmpID?>" />
          </div>
          <div class="form-group">
          <?php
        echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code" class="captcha_kod">';

        ?><input class="form-control pole_captcha" name="captcha_kod" id="captcha_kod" type="text" placeholder="Внесете го кодот од горната слика" />
          </div>
            <button type="submit" class="btn btn-primary pull-right submit">Внеси</button>
        </form>
      </div>