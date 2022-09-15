<?php
//rec id post 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<legend>Formulaire delete Category</legend>

<form method="post" action="/category/delete">

  <label for="category">category:</label><br>
  <input type="text" id="category" name="category" value=<?= $end?>><br><br>

  <input type="submit"class="btn btn-danger" value="Confirm your delete">
</form>