<?php 
  include_once __DIR__ . '/lib/get-post-data.php';
  include_once __DIR__ . '/lib/get-sql.php';
  include_once __DIR__ . '/lib/slected-button.php';
  include_once __DIR__ . '/lib/Paging.php';
  include_once __DIR__ . '/../db/pdo.php';
  

  class GetData{
    
    const MAX_POSTS = 10;  
  
    const MAX_PICKUP_POSTS = 5;

    private $category = "";

    private $tag = "";

    private $member = "";

    private $member_name = "";

    private $pdo;

    public $data;

    public $title = "";
    
    public $button_array = [];

    public $paging_html = "";


    public function __construct()
    {
      $connect = new Connect();
    
      $this->pdo = $connect -> connect_data();
    }

    
    public function getPickup(){

      $get_sql = new GetSql(self::MAX_POSTS);

      $isParams = $get_sql->getIsParams();
      
      $execute_array = $get_sql->getExecuteArray();
      
      $post_data = new GetPostData($this->pdo,$isParams,self::MAX_POSTS);
    
      $data_sql = $get_sql->getPickupDataSql(self::MAX_PICKUP_POSTS);

      $this->data = $post_data->getData($data_sql,$execute_array);
      
      $this->title = "注目の記事";
    }
    

    public function getData(){
      
      $get_sql = new GetSql(self::MAX_POSTS);
  
      $count_sql = $get_sql->getCountSql();
  
      $isParams = $get_sql->getIsParams();
  
      $params_array = $get_sql->getParamsArray();
      
      $execute_array = $get_sql->getExecuteArray();
      
      $post_data = new GetPostData($this->pdo,$isParams,self::MAX_POSTS);
  
      $count = $post_data->getRowCount($count_sql,$execute_array);
    
      $data_sql = $get_sql->getDataSql($count);
    
      $this->data = $post_data->getData($data_sql,$execute_array);
  
      $this->category = $get_sql->category;
  
      $this->tag = $get_sql->tags;

      $this->member = $get_sql->member;
      foreach($params_array as $row){
        if(!empty($row["params"])){
          $button = selected_button($row);
          array_push($this->button_array,$button);
        }
      }
  

      if(!empty($this->member)){
        $this->add_button_array();
      }
  
      $this->setTitle();

      $paging = new Paging(self::MAX_POSTS);
  
      $paging -> setHtml($count);
  
      $this->paging_html = $paging->html;
    }

    
    private function add_button_array()
    {
      $sql = "SELECT member_name FROM member WHERE id = :id";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":id", $this->member);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $this->member_name = $data[0]["member_name"];
      $member_array = 
        [
        "name" => "member",
        "params" => $data[0]["member_name"]
        ];
      $member_button = selected_button($member_array);
      array_push($this->button_array,$member_button);
    }
  
    private function setTitle()
    {
      $title_text = 'キーワード"';
      $title_end_text = '"';
      $count = 0;
      if(!empty($this->category)){
        $title_text.=$this->category.",";
        $count++;
      }
      if(!empty($this->tag)){
        $title_text.=$this->tag.",";
        $count++;
      }
      if(!empty($this->member)){
        $title_text.=$this->member_name.",";
        $count++;
      }
      if($count == 0){
        $this->title = "記事一覧を表示";
      }else{
        $title = rtrim($title_text, ",");
        $this->title = $title.$title_end_text;
      }
    }
  }

  ?>