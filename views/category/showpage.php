<?php

use App\Services\Connection;

$pdo = Connection::getInstance()->getPdo();
$results = $pdo->query("SELECT * FROM category", PDO::FETCH_ASSOC);
?>
<legend class="text-center">Show all categories</legend>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Category</th>
            <th scope="col" class="text-center">Manager</th>

        </tr>

    </thead>
    <tbody>
        <?php foreach ($results as  $value) { ?>
            <tr>
                <td scope="row"><?= $value['id']; ?></td>
                <td scope="row"><?= $value['name']; ?></td>
                <td scope="row" class="text-center">
                    <a href="/category/updatepage/<?= $value['id']; ?>" class="btn btn-success">Update</a>
                    <a href="/category/delete-page/<?= $value['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php  } ?>
    </tbody>
</table>