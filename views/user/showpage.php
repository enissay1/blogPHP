<?php

use App\Services\Connection;

$pdo = Connection::getInstance()->getPdo();
$results = $pdo->query("SELECT * FROM user", PDO::FETCH_ASSOC);
?>
<legend class="text-center">Show all Users</legend>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>

        </tr>

    </thead>
    <tbody>
        <?php foreach ($results as  $value) { ?>
            <tr>
                <td scope="row"><?= $value['id']; ?></td>
                <td scope="row"><?= $value['username']; ?></td>
                <td scope="row" class="text-center">
                    <a href="/user/updatepage/<?= $value['id']; ?>" class="btn btn-success">Update</a>
                    <a href="/user/delete-page/<?= $value['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php  } ?>
    </tbody>
</table>