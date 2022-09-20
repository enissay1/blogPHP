<?php
namespace App\Services;
use PDO;
class Connection
{

  /**
   * @var Singleton
   * @access private
   * @static
   */
  private static $_instance = null;
  private $servername = "localhost";
  private $username = "root";
  private $password = "";

  private $pdo;

  private function __construct()
  {
   
  }
  //remplir $this->pdo avec objet connection une seul fois
  public function getPdo()
  {
    if($this->pdo) {
      return $this->pdo;
    }

    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_CASE => PDO::CASE_NATURAL,
      PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING
    ];
    try {
      $this->pdo = new PDO("mysql:host=$this->servername;dbname=blog", $this->username, $this->password);
      // set the PDO error mode to exception
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // set  mode fetch
      //$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);


      return $this->pdo;
    } catch (\PDOException $e) {
      echo "Connection failed to DB: " . $e->getMessage();
    }
  }

     /**
    * Méthode qui crée l'unique instance de la classe connection
    * si elle n'existe pas la retourne.
    *
    * @param void
    * @return Singleton
    */
    public static function getInstance() {
 
      if(is_null(self::$_instance)) {
        self::$_instance = new Connection();  
      }
  
      return self::$_instance;
    }
}
