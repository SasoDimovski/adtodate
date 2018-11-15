<?php 
$search=$_GET["srch-term"];
?>
<nav class="navbar" role="navigation">
  <div class="siv">
    <div class="container"> 
      <!-- Brand and toggle get grouped for better mobile display --> 
      
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse kolaps mini_meni" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav navbar-left">
          <li style="list-style-image:none"> <a href="http://www.kliker.com.mk/" target="_blank">powered by <img src="../images/kliker.png" width="33" height="7" alt="kliker"/></a> </li>
        </ul>
        <div class="pull-right">
          <form class="prebaruvanje" role="search" action="records.php"  method="get">
            <div class="input-group">
              <input type="text" class="" placeholder="Search..." name="srch-term" id="srch-term" maxlength="50" value="<?php echo $search?>">
              
              <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </form>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li style="list-style-image:none"> <a><i class="fa fa-phone" aria-hidden="true"></i> +389 2 3067 572</a></li>
          <li> <a href="record.php?mv=2&id=2">About</a> </li>
          <li> <a href="record.php?mv=6&id=6">Contact</a> </li>
          <li> <a href="rss.php">rss</a> </li>
          <li> <a href="https://www.facebook.com/adtodate/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
          <li> <a href="https://twitter.com/AdToDate" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
         <!-- <li> <a href="index.php"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>-->
          <li> <a style="padding-right:0">&nbsp;</a></li>
        </ul>
        
      </div>
      <!-- /.navbar-collapse --> 
    </div>
  </div>
  <div class="container banner_top" style="padding-left:10px">
        <!-- BANNER POZICIJA 1 ili 2  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                                <?php 
								
                                //=====================================================================================================================================
                                $sql2 = "SELECT *
                                FROM baners
                                WHERE (position =1 or position =2)
                                AND publish =1
                                order by
                                create_date desc, pr desc, id desc 
                                LIMIT 0 , 1";
                                //die($sql);
                                $result2=mysqli_query($con, $sql2);
                                $rowcount2=mysqli_num_rows($result2);
								$banners3=$rowcount2;
                                //if ($result){$row = mysqli_fetch_array($result);}
                                //=====================================================================================================================================
                                ?>

                                                <?php if ($rowcount2==0){?>
                                                <?php } else {?>
													<?php	
                                                    while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)) { 
                                                    $i=$i+1;
                                                    $create_date=$row["create_date"];
                                                    $edit_date=$row["edit_date"];
                                                    //if ($create_date) {$create_date=date_format(new DateTime($create_date), 'd M, Y H:i:s');}
                                                    if ($create_date) {$create_date=strftime("%d %b %Y", strtotime($create_date));};
                                                    if ($edit_date) {$edit_date=date_format(new DateTime($edit_date), 'd.m.Y H:i:s');}
                                                   ?>
                                                   <?php echo $row["text"];?>                                                
                                                    <?php } ?>
                                                <?php }?>
                                                

                                 <?php  mysqli_free_result($result2);?>
                
                

          <!-- BANNER POZICIJA 1 ili 2   KRAJ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
          </div>
  <div class="container" style="margin-top: 30px;"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".kolaps"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php"><img src="../images/adtodate_logo.png" width="184" height="26" alt="adtodate"/></a> </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse kolaps" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right boi">
        <li class="kat_creative"> <a href="records.php?mv=9">Creative</a> </li>
        <li class="kat_campaing"> <a href="records.php?mv=10">Admen</a> </li>
        <li class="kat_digital"> <a href="records.php?mv=11">Campaigns</a> </li>
        <li class="kat_madmen"> <a href="records.php?mv=12">Digital</a> </li>
        <li class="kat_local"> <a href="records.php?mv=13">Local</a> </li>
        <li class="kat_festival"> <a href="records.php?mv=14">Festivals</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container --> 
</nav>