<?php
use App\Entity\Post;
 use App\Services\Connection;
$pdo=Connection::getInstance()->getPdo();
//query count
$queryCount="SELECT COUNT(id) as countPost FROM post";
$count=$pdo->query($queryCount);
$nbTotal=(int)$count->fetch()['countPost'];//nombre de post total
$nbPages=ceil($nbTotal/3);//number de page total

if(!empty($_GET['p'])&& is_numeric($_GET['p'])){
    $getPage=(int)$_GET['p'];
       }else $getPage=1;
$offset=($getPage-1)*3;

// query to show
$query=$pdo->query("SELECT * FROM post ORDER BY publishedAt DESC LIMIT 3 OFFSET $offset");
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

<div class="d-flex justify-content-between my-4">
<?php
if ($getPage>1){
        $p=array('p'=>($getPage-1));
        $merge=array_merge($_GET,$p);
        $url=http_build_query($merge);
        if ($url==="p=1"){$url="";}else $url;
        echo" <a href=?". $url ." name='precedente' class='btn btn-primary'>page precedente</a> ";
    }
   if ($getPage<ceil($nbPages)){
        $p=array('p'=>($getPage+1));
        $merge=array_merge($_GET,$p);
        $url=http_build_query($merge);
        echo" <a href=?". $url ." name='suivante' class='btn btn-primary ms-auto'>page suivante</a> ";
    }
    ?>
</div>