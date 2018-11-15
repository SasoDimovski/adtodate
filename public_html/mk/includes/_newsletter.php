<div class="share_modul">
  <?php
$broj = rand(1000, 9999);
?> 
  <script language="JavaScript">
    <!--
    
    function validacijaNewsletter()
    {
        //alert(); return false;
    //if (document.getElementById('name').value==''){alert('Полето за име е задолжително!');return false;}
    if (document.getElementById('email').value==''){alert('Полето за email е задолжително!');return false;}
	if (document.getElementById('captcha').value!='<?php echo $broj?>'){alert('Кодот не е точен!');return false;}
    document.getElementById("formV").submit();
    }
    //-->
    </script>
  <div class="linija">
    <div class="kategorija_h">Пријава за Newsletter</div>
  </div>
  <div class="madmen_mali">
    <form action="_newsletter_rec.php" role="form" name="formV" id="formV" method="post" onSubmit="return validacijaNewsletter();">
      <input placeholder="Име и презиме" required type="text" id="name" name="name" maxlength="50" value="<?php echo $_SESSION["NEWSLETTER_NAME"];?>" class="newsletter">
      <input placeholder="Email" required type="text" id="email" name="email" maxlength="50" value="<?php echo $_SESSION["NEWSLETTER_EMAIL"];?>" class="newsletter">
      <?php
        echo '<div src="' . $broj['image_src'] . '" style="display:block; overflow:hidden; clear:both; margin: 10px 0 0 0;position: relative; padding:3px; ">'.$broj.'</div>';
        ?>
      <input class="newsletter" required name="captcha" id="captcha" type="text" placeholder="Внесете го горниот код">
      <button type="submit" value="" class="newsletter"><i class="fa fa-envelope" aria-hidden="true"></i> Пријави се</button>
    </form>
  </div>
</div>
