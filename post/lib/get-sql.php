<?php

class GetSql{
  
  protected $max_posts;

  private $count_sql = "SELECT COUNT(*) as cnt";

  private $data_sql_start = "SELECT m.*,i.image_name,s.source_name";

  private $data_sql_main_table = " FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id";

  private $select_category = ",c.category_name";

  private $join_category = " LEFT OUTER JOIN category c on m.category_id = c.id";

  private $select_tag = ",t.tag_name";
  
  private $join_tag = " LEFT OUTER JOIN tag_list tl on m.id = tl.main_id LEFT OUTER JOIN tag t on tl.tag_id = t.id";

  private $pickup_sql = "SELECT m.*,p.id AS 'pickup_id',i.image_name,s.source_name FROM main m LEFT OUTER JOIN image i ON m.image_id = i.id LEFT OUTER JOIN source s ON m.source_id = s.id RIGHT OUTER JOIN pickup p ON m.id = p.main_id ORDER BY p.id DESC";

  private $order_by = " ORDER BY m.date";

  private $sql;

  private $tpl = "";

  public $category = "";

  public $sort = 1;

  public $tags = "";

  public $member = "";

  protected $params_array;

  public $now_page = 1;

  public $data;

  private $count;

  private $max_post;

  private $min_post;

  private $is_params = false;

  private $execute_array = [];

  public function __construct($max_posts)
  {
    $this->max_posts = $max_posts;
  }

  private function setCategoryTpl(){
    $this->tpl = $this->select_category.$this->data_sql_main_table.$this->join_category;
  }

  private function setTagTpl(){
    $this->tpl = $this->data_sql_main_table;
  }

  private function setAllTpl(){
    $this->tpl = $this->select_category.$this->data_sql_main_table.$this->join_category;
  }

  private function setBaseTpl(){
    $this->tpl = $this->select_category.$this->data_sql_main_table.$this->join_category;
  }

  private function setParams(){
    #パラメータを取得する
    if(!empty($_GET['category'])){
      $this->category = htmlspecialchars($_GET['category'], ENT_QUOTES, 'UTF-8');
      $this->is_params = true;
    }
    if(!empty($_GET['sort'])){
      $this->sort = htmlspecialchars($_GET['sort'], ENT_QUOTES, 'UTF-8');
    }
    if(!empty($_GET['tag'])){
      $this->tags = htmlspecialchars($_GET['tag'], ENT_QUOTES, 'UTF-8');
      $this->is_params = true;
    }
    if(!empty($_GET['member'])){
      $this->member = htmlspecialchars($_GET['member'], ENT_QUOTES, 'UTF-8');
      $this->is_params = true;
    }
  }

  private function setParamsArray(){
    #配列を設定する
    $this->params_array = 
    [
      [
        "name" => "category",
        "key" => "c",
        "params" => $this->category,
        "sql" => "c.category_name = :category_name"
      ],
      [
        "name" => "tag",
        "key" => "t",
        "params" => $this->tags,
        "sql" => "m.id IN (SELECT tl.main_id FROM tag_list tl WHERE tl.tag_id IN (SELECT t.id FROM tag t WHERE t.tag_name = :tag_name))"
      ]
    ];
  }

  public function getParamsArray(){
    return $this->params_array;
  }

  private function setTpl($sql){
    $this->sql = $sql;
    if((!empty($this->category)) and (!empty($this->tags))){
      $this->setAllTpl();
    }elseif(!empty($this->category)){
      $this->setCategoryTpl();
    }elseif(!empty($this->tags)){
      $this->setTagTpl();
    }else{
      $this->setBaseTpl();
    }
    $this->sql .= $this->tpl;
  }
  
  private function setPage(){
    #何ページが取得する
    if(!empty($_GET['post_page'])){
      $this->now_page = htmlspecialchars($_GET['post_page'], ENT_QUOTES, 'UTF-8');
    }
  }

  private function addWhere(){
    $add_where = " WHERE";
    $and = " ";
    $count = 0;
    foreach($this->params_array as $value){
      if(!empty($value["params"])){
        $key = $value["key"];
        $name = $value["name"];
        $params = $value["params"];
        $sql = $value["sql"];
        $sql_key = ":".$name."_name";
        $this->execute_array[] = [
          "key" => $sql_key,
          "value" => $params,
        ];
        $add_where .= $and.$sql;
        $and = " AND ";
        $count++;
      }
    }
    if(!empty($this->member)){
      $add_where .= $and."m.member_id = ".$this->member;
    }

    $this->sql .= $add_where;
  }

  public function getIsParams(){
    return $this->is_params;
  }
  public function getExecuteArray(){
    return $this->execute_array;
  }

  private function addLimit(){
    $this->setPage();
    #SQLのLIMITを設定する
    $this->min_post = ($this->now_page-1) * $this->max_posts;
    $this->max_post = $this->now_page * $this->max_posts;
    $this->sql .= " LIMIT ".$this->min_post.",".$this->max_post;
  }

  private function addOrderBy(){
    $order_by = "";
    if($this->sort == 2){
      $order_by = $this->order_by . " ASC";
    }else{
      $order_by = $this->order_by . " DESC";
    }
    $this->sql .= $order_by;
  }

  public function getCountSql(){
    $this->setParams();
    $this->setParamsArray();
    $this->setTpl($this->count_sql);
    if($this->is_params){
      $this->addWhere();
    }
    return $this->sql;
  }

  public function getDataSql($count){
    $this->count = $count;
    $this->setParams();
    $this->setParamsArray();
    $this->setTpl($this->data_sql_start);
    if($this->is_params){
      $this->addWhere();
    }
    $this->addOrderBy();
    if($this->min_post < $this->count){
      $this->addLimit();
    }
    return $this->sql;
  }

  private function addPickupLimit($limit){
    $limit_sql =  " LIMIT 0".$limit;
    return $limit_sql;
  }
  
  public function getPickupDataSql($limit){
    $limit_sql = $this->addPickupLimit($limit);
    $pickup_sql = $this->pickup_sql.$limit_sql;
    return $pickup_sql;
  }
}

?>