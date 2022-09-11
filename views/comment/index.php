<script>
    window.onload = function() {
        // Some 
        document.getElementById("textAreaExample").value = "";
    };
</script>
<?php

use App\Services\Connection;

$pdo = Connection::getInstance()->getPdo();
$query = $pdo->prepare("SELECT * FROM comment WHERE id_post=:id_post");
$explode = explode("/", $_SERVER['REQUEST_URI']);
$end = end($explode);
//$end = (int)substr($_SERVER['REQUEST_URI'], -1);
$query->execute(array("id_post" => $end));
$results = $query->fetchALL(pdo::FETCH_ASSOC);
//dump($results);die();
// foreach ($results as  $value) {
//  dump($value);
// }

?>

<section style="background-color: #eee;">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">

            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <?php foreach ($results as  $value) { ?>

                        <div class="card-body">
                            <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60" height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1"><?= $value["pseudo"] ?></h6>
                                    <p class="text-muted small mb-0">
                                        Shared publicly - <?= $value["createdAt"] ?>
                                    </p>
                                </div>
                            </div>

                            <p class="mt-3 mb-4 pb-2"><?= $value["content"] ?></p>

                            <div class="small d-flex justify-content-start">
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-thumbs-up me-2"></i>
                                    <p class="mb-0">Like</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-comment-dots me-2"></i>
                                    <p class="mb-0">Comment</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="fas fa-share me-2"></i>
                                    <p class="mb-0">Share</p>
                                </a>
                            </div>
                            <br>
                            <a href="/comment/updatepage/<?=$value["id"]?>" class="btn btn-success btn-sm">Update comment</a>
                            <a href="/comment/delete-page/<?=$value["id"]?>" class="btn btn-danger btn-sm">Delete comment</a>
                        </div>
                    <?php } ?>

                    <form method="post" action="/comment/add">
                        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                            <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40" height="40" />
                                <div class="form-outline w-100">
                                    <input type="text" name="pseudo" placeholder="pseudo" class="input-group-text"><br>
                                    <input type="hidden" name="id_post" value=<?= $end ?>>
                                    <textarea name="comment" class="form-control" id="textAreaExample" rows="4" style="background: #fff;"></textarea>
                                    <label class="form-label" for="textAreaExample">New Comment</label>
                                </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                                <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                <button type="reset" class="btn btn-outline-primary btn-sm">Cancel</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>