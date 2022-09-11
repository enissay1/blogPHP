<?php 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);

?>
<legend>Formulaire update comment</legend>

<form method="post" action="/comment/update">
  <input type="hidden" id="id" name="id" value="<?=$end?>"><br>

  <label for="pseudo">pseudo:</label><br>
  <input type="text" id="pseudo" name="pseudo"><br>

  <label for="comment">comment:</label><br>
  <textarea name="comment" id="comment" cols="30" rows="10"></textarea><br>

  <input type="submit"class="btn btn-primary" value="update comment">
</form>