<?php 

require_once __DIR__ . '/../lib/env.php';

loadEnv(__DIR__ . '/../.env');

class Connect{

  private $host;

  private $utf;

  private $user;

  private $pass;

  private $name;

  function __construct()
  {
    $this->host = getenv('DB_HOST');

    $this->utf = getenv('DB_UTF'); 

    $this->user = getenv('DB_USER');

    $this->pass = getenv('DB_PASS');

    $this->name = getenv('DB_NAME');
  }

  function connect_data()
  {

    $dsn = "mysql:dbname={$this->name};host={$this->host};charset={$this->utf}";

    $user=$this->user;

    $pass=$this->pass;

    try
    {
      
      $pdo = new PDO($dsn,$user,$pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }catch(PDOException $Exception){

        die('接続エラー：' .$Exception->getMessage());

    }

    return $pdo;
    
  }
}

    ?>