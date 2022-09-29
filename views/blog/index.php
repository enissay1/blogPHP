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
        <?php
        //dump($post->getCover());die();
         $filename = $post->getCover();

         list($width, $height, $type, $attr) = getimagesize($filename);//create var from array getimagesize
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
             $target_file = $target_dir . basename($post->getCover()    );
             file_put_contents($target_file, file_get_contents($post->getCover()    ));              //dump($target_file);die();
             //dump($target_file);die();
         }
        ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <img src="\images\thumbnail\<?= basename($post->getCover()) ?>" alt="book html&css">
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
        echo" <a href=?". $url ." name='Previous' class='btn btn-primary'>Previous page </a> ";
    }
   if ($getPage<ceil($nbPages)){
        $p=array('p'=>($getPage+1));
        $merge=array_merge($_GET,$p);
        $url=http_build_query($merge);
        echo" <a href=?". $url ." name='Next' class='btn btn-primary ms-auto'>Next page </a> ";
    }
    ?>
</div>