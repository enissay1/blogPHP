<?php 
use App\Html\Form;

$form=new Form;
?>
<legend>Formulaire Add Category</legend>

<form method="post" action="/category/add">

  <?= $form->input("category","text","Category");?><br>

  <input type="submit"class="btn btn-primary" value="Add category">
</form>
