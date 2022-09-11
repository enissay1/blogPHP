<?php

namespace App\Controllers;

use App\Managers\CommentManager;

class CommentController
{

  private $Commentmanager;
  public function __construct()
  {
    $this->commentmanager = new CommentManager();
  }
  public function addComment()
  {
    if (isset($_POST["comment"]) && !empty($_POST["comment"])) {
      //dump($_POST);die();
      $this->commentmanager->add($_POST["pseudo"],$_POST["comment"],(int)$_POST["id_post"]);
      echo 'comment  added successfully <input type="button" value="back to last page" onclick="history.go(-1)">';
    } else echo 'verify fields';
  }

  public function updatecomment()
  {
    if (isset($_POST["comment"]) && !empty($_POST["id"])) {
      $id = $this->commentmanager->find($_POST["id"]);
      //dump($id);die();
      if ($id == true) {
        $this->commentmanager->update($_POST["id"],$_POST["pseudo"],$_POST["comment"]);
        echo 'comment  updated';
      } else echo  "<br>this id don t exist try another";
    } else echo 'verify fields';
  }

  public function deletecomment()
  {
    if (isset($_POST["id"])) {
      $comment = $this->commentmanager->find($_POST["id"]);
      if (is_array($comment)) {
        $this->commentmanager->delete($_POST["id"]);
        echo 'comment  deleted';
      } else echo  "<br>this comment don t exist try another";
    } else echo 'verify fields';
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
