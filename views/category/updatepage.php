<?php
//rec id post 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<legend>Formulaire update Category</legend>

<form method="post" action="/category/update">
<label for="id">id:</label><br>
  <input type="text" id="id" name="id"  value=<?= $end?>><br>
  <label for="category">category:</label><br>
  <input type="text" id="category" name="category"><br><br>

  <input type="submit"class="btn btn-success" value="update category">
</form>