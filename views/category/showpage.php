
<?php
use App\Managers\CategoryManager;
use App\Services\Connection;

$pdo = Connection::getInstance()->getPdo();
$catMan = new CategoryManager;
$results = $catMan->findAllClass();
//$cat = new Category;
?>
<legend class="text-center">Show all categories</legend>

<br><br><br>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Category</th>
            <th scope="col" class="text-center">Manager</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as  $cat) { ?>
            <tr>
                <td scope="row"><?= $cat->getId() ?></td>
                <td scope="row"><?= $cat->getName() ?></td>
                <td scope="row" class="text-center">
                    <a href="/category/updatepage/<?= $cat->getId(); ?>" class="btn btn-success">Update</a>
                    <a href="/category/delete-page/<?= $cat->getId(); ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php  } ?>
    </tbody>
</table>