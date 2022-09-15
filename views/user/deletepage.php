
<?php
//rec id post 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<title>delete your compte</title>
<form method="post" action="/user/delete">
  
  <label for="username">User:</label><br>
  <input type="text" id="username" name="username" value=<?= $end?>><br><br>



  <input type="submit"class="btn btn-danger" value="Confirm your delete">

</form>