<legend>Formulaire Add Comment</legend>

<form method="post" action="/comment/add">

  <label for="pseudo">pseudo:</label><br>
  <input type="text" id="pseudo" name="pseudo"><br><br>

  <textarea name="comment" id="comment" cols="30" rows="10" placeholder="comment"></textarea><br><br>
<!-- id post rec from session -->
  <input type="submit"class="btn btn-primary" value="Add Comment">
</form>
