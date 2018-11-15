<div class="well">
  <h4>Leave a Comment:</h4>
  <form role="form" action="includes/forum/_insert_post.php" method="post" enctype="application/x-www-form-urlencoded">
    <div class="form-group">
      <textarea class="form-control" rows="3" name="post" id="post"></textarea>
      <input name="parent" type="hidden" value="<?php echo intval($_GET["parent"])?>" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
