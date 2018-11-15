<?php $tmpMV = $_GET["mv"] ;?>
<?php if ($tmpMV == "") {$tmpMV = "11";} ;?>
<section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
 

                        <?php if ($tmpMV == "1"||$tmpMV == "2"||$tmpMV == "3"||$tmpMV == "4") {$t = "active";}?>
                        <?php if ($tmpMV == "1") {$t1 = "active";}?>
                        <?php if ($tmpMV == "2") {$t2 = "active";}?>
                        <?php if ($tmpMV == "3") {$t3 = "active";}?>
                        <?php if ($tmpMV == "4") {$t4 = "active";}?>
                        
                        <li class="treeview <?php echo $t?>">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo $t1?>"><a href="UIgeneral.php?mv=1"><i class="fa fa-angle-double-right"></i> General</a></li>
                                <li class="<?php echo $t2?>"><a href="UIbuttons.php?mv=2"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                                <li class="<?php echo $t3?>"><a href="UIsliders.php?mv=3"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                                <li class="<?php echo $t4?>"><a href="UIjquery-ui.php?mv=4"><i class="fa fa-angle-double-right"></i> Jquery</a></li>
                            </ul>
                        </li>
                        
                         <?php if ($tmpMV == "5"||$tmpMV == "6"||$tmpMV == "7") {$s = "active";}?>
                        <?php if ($tmpMV == "5") {$s5 = "active";}?>
                        <?php if ($tmpMV == "6") {$s6 = "active";}?>
                        <?php if ($tmpMV == "7") {$s7 = "active";}?>
   
                        
                        <li class="treeview <?php echo $s?>">
                            <a href="#">
                                <i class="fa fa-edit"></i> 
                                <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo $s5?>"><a href="Fgeneral.php?mv=5"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li class="<?php echo $s6?>"><a href="Fadvanced.php?mv=6"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li class="<?php echo $s7?>"><a href="Feditors.php?mv=7"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                            </ul>
                        </li>
                        
                         <?php if ($tmpMV == "8"||$tmpMV == "9") {$m = "active";}?>
                        <?php if ($tmpMV == "8") {$m8 = "active";}?>
                        <?php if ($tmpMV == "9") {$m9 = "active";}?>
                        <li class="treeview  <?php echo $m?>">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo $m8?>"><a href="Tsimple.php?mv=8"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li class="<?php echo $m9?>"><a href="Tdata.php?mv=9"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                        
                        


                    </ul>
                </section>