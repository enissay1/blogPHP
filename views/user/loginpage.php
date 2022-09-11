<form method="POST" action="/user/login">

    <h1>Welcome to login page:</h1>

    <input type="text" name="username" placeholder="Your username" value="<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>"><br><br>

    <input type="password" name="password" placeholder="Your password" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>"><br><br>

    <input type="checkbox" name="check" id="check">
    <label for="check">remember me</label><br><br>


    <td align="center"><br><input type="submit" class="btn btn-primary" value="Connect">


</form>