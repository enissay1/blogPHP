<?php
use App\Html\Form;
$form=new Form;
//rec id post 
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
?>
<legend>Formulaire delete Category</legend>

<form method="post" action="/category/delete">

<?= $form->input("category","text","Category",$end)?><br>

  <input type="submit"class="btn btn-danger" value="Confirm your delete">
</form>