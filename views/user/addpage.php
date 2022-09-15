<?php 
use App\Html\Form;
$form= new Form;
?>
<legend>Exemple de formulaire Add User</legend>

<form method="post" action="/user/add">
  <!-- <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br> -->
<?= $form->input("email","text","Email")?>
  <label for="Username">Username:</label><br>
  <input type="text" id="Username" name="username"><br>

  <label for="password">password:</label><br>
  <input type="password" id="password" name="password"><br><br>

  <input type="submit"class="btn btn-primary" value="submit">
</form>
