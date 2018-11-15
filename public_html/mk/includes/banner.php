          <!-- BANNER POZICIJA   /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                                <?php 
								
                                //=====================================================================================================================================
                                $sql2 = "SELECT *
                                FROM baners
                                WHERE position =".$bannerID."
                                AND publish =1
                                order by
                                create_date desc, pr desc, id desc 
                                LIMIT 0 , 1";
                                //die($sql);
                                $result2=mysqli_query($con, $sql2);
                                $rowcount2=mysqli_num_rows($result2);
								$banners=$rowcount2;
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
                
                

          <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->