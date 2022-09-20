<?php 
namespace App\Services;

class LiveSearch {

    public function search($sql){
       $pdo= Connection::getInstance()->getPdo();

//$sql="";
$query=$pdo->query($sql,\PDO::FETCH_ASSOC);
$results=$query->fetchAll();
// get the q parameter from URL
//var_dump($sql,$_GET);
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($results as $name) {
    if (stristr($q, substr($name['name'], 0, $len))) {
      if ($hint === "") {
        $hint = "<a href='#'>{$name['name']}</a>";
      } else {
        $hint .= "<br><a>{$name['name']}</a>";
      }
    }
    //echo$name['title'];
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;

    }
}