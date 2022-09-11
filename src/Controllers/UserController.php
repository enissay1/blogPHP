<?php

namespace App\Controllers;

use App\Managers\UserManager;

class UserController
{

  private $usermanager;
  public function __construct()
  {
    $this->usermanager = new UserManager();
  }
  public function addUser()
  {
    if (isset($_POST["username"]) && !empty($_POST["password"])) {
      $username = $this->usermanager->find($_POST["username"]);
      if ($username == false) {
        $this->usermanager->add($_POST["email"], $_POST["username"], $_POST["password"]);
        echo 'user  add';
      }else echo  "<br>this username exist try another";
    }else echo 'verify fields';
  }

  public function updateUser()
  {
    if (isset($_POST["username"]) && !empty($_POST["password"])) {
      $id = $this->usermanager->find($_POST["id"]);
      if ($id == true) {
        $this->usermanager->update($_POST["id"],$_POST["email"], $_POST["username"], $_POST["password"]);
        echo 'user  updated';
      }else echo  "<br>this id don t exist try another";
    }else echo 'verify fields';
  }

  public function deleteUser()
  {
    if (isset($_POST["username"])) {
      $username = $this->usermanager->find($_POST["username"]);
      if ($username == true) {
        $this->usermanager->delete($_POST["username"]);
        echo 'user  deleted';
      }else echo  "<br>this id don t exist try another";
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
