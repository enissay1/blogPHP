<?php

use App\Entity\Post;
use App\Services\Connection;

$pdo = Connection::getInstance()->getPdo();
$query = $pdo->prepare("SELECT * FROM post WHERE id=:id");
$q = $pdo->prepare("SELECT name FROM category WHERE id=:id");
$explode = explode("/",$_SERVER['REQUEST_URI']);
$end=end($explode);
$query->execute(array("id" => $end));
$results = $query->fetchAll(pdo::FETCH_ASSOC);
 //dump($results,$end);die();
?>
<h1>Blog</h1>
<div class="row">
    <?php foreach ($results as $post) : ?>
        <?php
        $q->execute(array("id" => (int)$post["id_category"]));
        $category = $q->fetch();
        ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="title"><?= $post["title"] ?></h5>
                    <p><?= $post["description"] ?></p>
                    <p><span>createdAt :</span><?= $post["createdAt"] ?></p>
                    <p><span>publishedAt : </span><?= $post["publishedAt"] ?></p>
                    <p>category :<?= $category['name']; ?></p>
                    <p>Author :<?= $_SESSION['username'] ?></p><br>
                </div>
            <?php endforeach ?>
            </div>
            <div>
                <form method="post" action="/comment/add">
                    <label for="pseudo">pseudo:</label><br>
                    <input type="text" id="pseudo" name="pseudo"><br><br>
                    <input type="hidden" name="id_post" value=<?= (int)$end ?>>
                    <textarea name="comment" id="comment" cols="30" rows="10" placeholder="content" class="bg-gray-200__input"></textarea><br><br>
                    <input type="submit" class="btn btn-primary" value="Add comment">
                </form>
            </div>


        </div>

</div>