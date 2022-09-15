
<?php
//rec id post 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<legend>Exemple de formulaire Update User</legend>
<form method="post" action="/user/update">
  <label for="id">id:</label><br>
  <input type="text" id="id" name="id" value=<?= $end?>><br>

  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>

  <label for="Username">Username:</label><br>
  <input type="text" id="Username" name="username"><br>

  <label for="password">password:</label><br>
  <input type="password" id="password" name="password"><br><br>

  <input type="submit"class="btn btn-success" value="Update">

</form>