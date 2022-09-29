<?php

use App\Entity\Post;
use App\Services\Connection;

$pdo = Connection::getInstance()->getPdo();
$query = $pdo->prepare("SELECT * FROM post WHERE id=:id");
$q = $pdo->prepare("SELECT name FROM category WHERE id=:id");
$q2 = $pdo->prepare("SELECT username FROM user WHERE id=:id");

$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
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
        $q2->execute(array("id" => (int)$post["id_user"]));
        $author = $q2->fetch();
        //thumbnail

        $filename = $post['cover'];

        list($width, $height, $type, $attr) = getimagesize($filename); //create var from array getimagesize
        //    dump(getimagesize($filename));die();
        $maxDim = 200; //chose dimension max for thumb
        //if ($width >= $maxDim || $height >= $maxDim) {
        $target_filename = $filename;
        $ratio = $width / $height;
        if ($ratio > 1) {
            $new_width = $maxDim;
            $new_height = $maxDim / $ratio;
        } else {
            $new_width = $maxDim * $ratio;
            $new_height = $maxDim;
            //}
            $src = imagecreatefromstring(file_get_contents($filename));
            $dst = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagedestroy($src);
            imagejpeg($dst, $target_filename); // adjust format as needed
            //var_dump(imagesx($dst));
            imagedestroy($dst);

            $target_dir = dirname(dirname(__DIR__)) . "/public/images/thumbnail/";
            $target_file = $target_dir . basename($post['cover']);
            file_put_contents($target_file, file_get_contents($post['cover']));              //dump($target_file);die();
            //dump($target_file);die();
        }

        ?>
        <svg width="10cm" height="4cm" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <image href="\images\thumbnail\<?= basename($post['cover']) ?>" x="0" y="0" height="50px" width="50px" />
        </svg>
        <div class="container">
            <div class="card" style="width: 15rem;">
                <img class="card-img-top" width="250px" height="250px" src="\images\thumbnail\<?= basename($post['cover']) ?>" alt="Card image">

                <div class="card-body">
                    <h5 class="title"><?= $post["title"] ?></h5>
                    <p><?= $post["description"] ?></p>
                    <p><span>createdAt :</span><?= $post["createdAt"] ?></p>
                    <p><span>publishedAt : </span><?= $post["publishedAt"] ?></p>
                    <p>category :<?= $category['name']; ?></p>
                    <p>Author :<?= $author["username"] ?></p><br>
                </div>
            </div>

        <?php endforeach ?>

        <div>
            <form method="post" action="/comment/add">
                <label for="pseudo">pseudo:</label><br>
                <input type="text" id="pseudo" name="pseudo"><br><br>
                <input type="hidden" name="id_post" value=<?= (int)$end ?>>
                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="content" class="bg-gray-200__input"></textarea><br><br>
                <input type="submit" class="btn btn-primary" value="Add comment">
            </form>
            <a href="/comment/post/<?= $end ?>">See All Comments</a>
        </div>


        </div>

</div>