<?php
use App\Entity\Post;
 use App\Services\Connection;
$pdo=Connection::getInstance()->getPdo();
$query=$pdo->query("SELECT * FROM post ORDER BY publishedAt DESC LIMIT 12");
$results=$query->fetchAll(PDO::FETCH_CLASS,Post::class);
//dump($results);
?>

<h1>Blog</h1>
<div class="row">
    <?php foreach($results as $post):?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h5 class="title"><?= $post->getTitle()?></h5>
                <p><?= $post->getDescription() ?></p>
                
                <a href="/blog/<?= $post->getId();?>" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>