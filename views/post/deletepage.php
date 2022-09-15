
<?php 
//rec id post 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<legend>Formulaire delete Post</legend>

<form method="post" action="/post/delete">

  <label for="post">post:</label><br>
  <input type="text" id="post" name="id_post" value=<?= $end?>><br>

  <input type="submit"class="btn btn-danger" value="Confirm your delete">
</form>