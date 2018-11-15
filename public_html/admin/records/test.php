<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$(function() {
    $( "#skills" ).autocomplete({
        source: 'autocomplete.php'
    });
});
</script>
<body>

<div class="ui-widget">
    <label for="skills">Skills: </label>
    <input id="skills">
</div>
</body>
</html>