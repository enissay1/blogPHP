<?php
use App\Services\Connection;
$pdo=Connection::getInstance()->getPdo();
$results=$pdo->query("SELECT * FROM post",PDO::FETCH_ASSOC);
?>
<legend class="text-center">Show all posts</legend>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">CreatedAt</th>
            <th scope="col">PublishedAt</th>
            <th scope="col">Description</th>
            <th scope="col">Id_User</th>
            <th scope="col">id_Category</th>

        </tr>
        
    </thead>
    <tbody>
        <?php foreach ($results as  $value) { ?>
        <tr>
            <td scope="row"><?=$value['id']; ?></td>
            <td scope="row"><?=$value['title']; ?></td>
            <td scope="row"><?=$value['createdAt']; ?></td>
            <td scope="row"><?=$value['publishedAt']; ?></td>
            <td scope="row"><?=$value['description']; ?></td>
            <td scope="row"><?=$value['id_user']; ?></td>
            <td scope="row"><?=$value['id_category']; ?></td>

        </tr>

        <?php  } ?>
    </tbody>
</table>