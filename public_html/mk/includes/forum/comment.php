<div class="well">
<?php
$parent=intval($_GET["parent"]);

session_start();
include("/simple-php-captcha-master/simple-php-captcha.php");
$_SESSION['captcha'] = simple_php_captcha();
?>
  <script language="JavaScript">
    <!--
    
    function validacijaContact<?php echo $parent?>()
    {
        //alert("validacijaUserPassCh"); return false;
    if (document.getElementById('name<?php echo $parent?>').value==''){alert('Полето за име е задолжително!');return false;}
    if (document.getElementById('post<?php echo $parent?>').value==''){alert('Полето за коментар е задолжително!');return false;}
	if (document.getElementById('captcha<?php echo $parent?>').value==''){alert('Полето за коментар е задолжително!');return false;}
	if (document.getElementById('captcha<?php echo $parent?>').value!='<?php echo $_SESSION['captcha']?>'){alert('Кодот не е точен!');return false;}
    document.getElementById("contactform<?php echo $parent?>").submit();
    }
    //-->
    </script>
  <h4>Оставете коментар:</h4>
  <form id="contactform<?php echo $parent?>" role="form" action="includes/forum/_insert_post.php" method="post" enctype="application/x-www-form-urlencoded" onSubmit="return validacijaContact<?php echo $parent?>()">
      <div class="form-group">
        <input class="form-control" required name="name" id="name<?php echo $parent?>" type="text" placeholder="Внесете го вашето име">
      </div>
    <div class="form-group">
      <textarea class="form-control" required rows="3" placeholder="Внесете го вашиот коментар" name="post" id="post<?php echo $parent?>"></textarea>
      <input name="parent" type="hidden" value="<?php echo $parent?>" />
      <input name="bez_captcha" type="hidden" value="1" />
    </div>
    <div class="form-group">
    <?php
        echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';

        ?>
    <input class="form-control" required name="captcha" id="captcha<?php echo $parent?>" type="text" placeholder="Внесете го горниот код">
      </div>
    <button type="submit" class="btn btn-primary pull-right submit">Внеси</button>
    <div style="clear:both; display:block"></div>
  </form>
</div>
