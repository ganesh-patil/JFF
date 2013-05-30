<?php
class databaseOperations{
    private static $connectionObject;
    public $ganesh='';
    public $select;
    public $from;
    public $where;
    private function __construct(){

    }

    public static function getObject(){
        if (self::$connectionObject === null) {
            self::$connectionObject= new  databaseOperations();
        }
        return self::$connectionObject;
    }
    public function select($fields){
        $this->select=' ';
        if (is_array($fields) && !empty($fields)){
            foreach($fields as $field){
                    $this->select.=$field.' ';
            }
        }
        else{
            $this->select=$fields.' ';
        }
    }

    function from (array $tableNames) {
         $this->from=' ';
        if(is_array($tableNames)  && !empty($tableNames)){
            foreach($tableNames as $table){
                $this->from.=$table.' ';
            }
        }
        else{
            $this->from.=$tableNames.' ';
        }
    }

    function where (array $conditions){
        $this->where="1=1";
            if(is_array($conditions ) && !empty($conditions)){
                foreach($conditions as $condition){
                    $this->where.= "AND ".$condition." ";
                }
        }
        else {
            $this->where.="AND".$conditions." ";
        }
    }

    function orderBy ($fieldName , $condition=null){
        if($fieldName){
            $this->orderby="ORDER BY ".$fieldName." ";
        }
        if($condition != "null"){
             $this->orderby.= $condition;
        }
    }
     function limit (integer $limit , $offset=null){
         $this->limit='';
           if($offset != null && $limit!=0){
               $this->limit="LIMIT ".$offset.",".$limit;
           }
         elseif($limit !=0){
             $this->limit="LIMIT ".$limit;
         }
   }

   function getInstance(){
       if(!isset(self::$connectionObject))
           self::$connectionObject = new PDO('mysql:host=localhost;dbname=test', 'root', 'webonise6186');

       return self::$connectionObject;

   }

    function get (){
        $db=$this->getInstance();
        $db->query($this->select()->from()->where()->orderby()->limit()->query());
    }
     function query (string $query) {

     }

}

databaseOperations::getObject();

?>