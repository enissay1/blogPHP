<?php 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<legend>Formulaire delete id_comment</legend>

<form method="post" action="/comment/delete">

  <input type="hidden" id="id" name="id" value=<?= $end?>><br><br>
<!-- id post rec from session -->

  <input type="submit"class="btn btn-danger" value="confirm your delete plz">
</form>