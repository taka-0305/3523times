<?php 

include_once __DIR__ . '/get-sql.php';

class GetPostData{

  public $data;

  public $max_page;

  private $count;

  private $pdo;
  
  private $isParams;

  private $max_posts;

  public function __construct($pdo,$isParams,$max_posts)
  {
    $this->pdo = $pdo;
    $this->isParams = $isParams;
    $this->max_posts = $max_posts;
  }

  private function getDB($sql,$execute_array)
  {
    #データベースからデータを取る
    $stmt = $this->pdo->prepare($sql);
    if($this->isParams){
      foreach($execute_array as $row){
        $stmt->bindValue($row["key"], $row["value"]);
      }
    }
    $stmt->execute();
    return $stmt;
  }

  public function getRowCount($count_sql,$execute_array)
  {
    #件数を取得する
    $stmt = $this->getDB($count_sql,$execute_array);
    $count = $stmt->fetch();
    $this->count = $count['cnt'];
    $this->max_page = ceil($this->count / $this->max_posts);
    return $this->count;
  }

  public function getData($data_sql,$execute_array)
  {
    #データを取得する
    $stmt = $this->getDB($data_sql,$execute_array);
    $this->data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $this->data;
  } 
}

?>