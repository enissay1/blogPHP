<?php 
use App\Services\Connection;
$pdo=Connection::getInstance()->getPdo();
$results=$pdo->query("SELECT * FROM category",PDO::FETCH_ASSOC);
//dump($_SESSION,$_POST);
?>
<legend>Formulaire Add Post</legend>
<form method="post" action="/post/add" enctype="multipart/form-data">

  <label for="title">title:</label><br>
  <input type="text" id="title" name="title"><br>

  <label for="createdAt">createdAt:</label><br>
  <input type="date" id="createdAt" name="createdAt"><br>

  <label for="publishedAt">publishedAt:</label><br>
  <input type="date" id="publishedAt" name="publishedAt"><br>

  <label for="description">description:</label><br>
  <input type="text" id="description" name="description"><br><br>

  <label for="cover">cover:</label><br>
  <input type="file" id="cover" name="cover"><br><br>

  <label for="category">Choose a category:</label>
  <select name="id_category" id="category">
   <?php foreach ($results as  $value) { ?> 
  <option value=<?=(int)$value['id']?>><?=$value['name']?></option>
  <?php }?>
 </select><br>


  <input type="submit"class="btn btn-primary" value="Add Post">
</form>