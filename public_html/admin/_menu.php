<?php
$tmpMV = intval($_GET["mv"]);
if ($tmpMV < 1) {$tmpMV = 1;} ;
//$menu = intval($_GET["menu"]);
?>

<aside class="left-side sidebar-offcanvas"> 
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu">
      <?php


$all_parents = get_path($tmpMV);
display_children_menu(0,1);
?>
    </ul>
  </section>
  <!-- /.sidebar --> 
</aside>
