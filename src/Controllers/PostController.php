<?php

namespace App\Controllers;

use App\Managers\PostManager;

class PostController
{

  private $postmanager;
  public function __construct()
  {
    $this->postmanager = new PostManager();
  }
  public function addPost()
  {
    if (isset($_POST["title"]) && !empty($_POST["title"])) {
      $title = $this->postmanager->find($_POST["title"]);
      if ($title == false) {
        $this->postmanager->add($_POST["title"],$_POST["createdAt"],$_POST["publishedAt"],$_POST["description"],$_FILES["cover"]["name"],$_POST["id_category"],(int)$_SESSION["id"]);
        echo 'post  added';
      }else echo  "<br>this post exist try another";
    }else echo 'verify fields';
  }

  public function updatePost()
  {
    if (isset($_POST["title"]) && !empty($_POST["id"])) {
      $id = $this->postmanager->find($_POST["id"]);
      //dump($id);die();
      if ($id == true) {
        $this->postmanager->update($_POST["id"],$_POST["title"],$_POST["createdAt"],$_POST["publishedAt"],$_POST["description"],$_FILES["cover"]["name"],$_POST["id_category"],$_SESSION["id"]);
        echo 'Post  updated';
      }else echo  "<br>this id don t exist try another";
    }else echo 'verify fields';
  }

  public function deletePost()
  {
    if (isset($_POST["post"])) {
      $post = $this->postmanager->find($_POST["post"]);
      if (is_array($post)) {
        $this->postmanager->delete($_POST["post"]);
        echo 'post  deleted';
      }else echo  "<br>this post don t exist try another";
    }else echo 'verify fields';
  }

  




}
 





//  
//   public function addUser()
//   {
//     if (isset($_POST["username"]) && !empty($_POST["password"])) {
//       $username = $this->usermanager->find($_POST["username"]);
//       if ($username['username'] === $_POST["username"]) {
//         $this->usermanager->add($_POST["email"], $_POST["username"], $_POST["password"]);
//         header('Location: ../views/home.php');
//       } else return  "<br>this username exist try another";
//     }
//   }
//   /*
//       user exist
//       */
//   public function user_exist($pdo)
//   {
//     if (isset($_POST["username"])) {
//       $this->username = $_POST["username"];
//       $insertRow = "SELECT username FROM User WHERE username=:username";

//       $result = $pdo->prepare($insertRow);
//       $result->execute(array("username" => $this->username));
//       $row = $result->fetch(); // return bool
//     }
//     if ($row === false) {
//       return true; // not exist you can add it
//     } else  return false;
//   }
// }
