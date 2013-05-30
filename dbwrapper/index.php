<?php
class databaseOperations{
    private static $connectionObject;
    private $select;
    private $from;
    private $where;
    private $orderby;
    private $limit;
    private $host="localhost";
    private  $username="root";
    private $password="webonise6186";
    private $dbname="jff";
    private function __construct(){

    }

    public function select($fields=null){
        $this->select=' ';
        if (is_array($fields) && !empty($fields)){
            foreach($fields as $field){
                    $this->select.=$field.' ';
            }
        }
        else{
            $this->select=$fields.' ';
        }
        return $this;
    }

    function from ($tableNames) {
         $this->from=' ';
        if(is_array($tableNames)  && !empty($tableNames)){
            foreach($tableNames as $table){
                $this->from.=$table.' ';
            }
        }
        else{
            $this->from.=$tableNames.' ';
        }
        return $this;
    }

    function where ($conditions=null) {
        $this->where=" 1=1 ";
            if(is_array($conditions ) && !empty($conditions)){
                foreach($conditions as $condition){
                    $this->where.= "AND ".$condition." ";
                }
        }
        elseif($conditions != null){
            $this->where.="AND ".$conditions." ";
        }
        return $this;
    }

    function orderBy ($fieldName , $condition=null){
        if($fieldName){
            $this->orderby="ORDER BY ".$fieldName." ";
        }
        if($condition != "null"){
             $this->orderby.= $condition;
        }
    }
     function limit ($limit , $offset=null){
         $this->limit='';
           if($offset != null && $limit!=0){
               $this->limit="LIMIT ".$offset.",".$limit;
           }
         elseif($limit !=0){
             $this->limit="LIMIT ".$limit;
         }
         return $this;
   }

   function getInstance(){
       try{
           if(!isset(self::$connectionObject)){
               self::$connectionObject = new PDO('mysql:host=localhost;dbname=jff', 'root', 'webonise6186');
               self::$connectionObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           return self::$connectionObject;
       }
       catch (Exception $e){
           echo "Exception";
       }


   }

    function get (){
        $query="SELECT ".$this->select."FROM ".$this->from."WHERE ".$this->where.$this->orderby." ".$this->limit;
        return $query;
    }

     function query ($query) {
         $dbo=$this->getInstance();
         return $dbo->prepare($query);
     }
    function dbOperations(){
        $dboInstance=new databaseOperations();
//        $query=$dboInstance->select("name")->from("organizations")->where()->get();
//        $result =$dboInstance->query($query);
//        $result->execute();
//        $allOrganizations=$result->fetchAll();
//        foreach($allOrganizations as $organization){
//            echo $organization['name']."\n";
//        }

//        $query=$dboInstance->select("name")->from("organizations")->where("Id > 10")->limit(10)->get();
//        $result =$dboInstance->query($query);
//        $result->execute();
//        $allOrganizations=$result->fetchAll();
//        foreach($allOrganizations as $organization){
//            echo $organization['name']."\n";
//        }

//        $query=$dboInstance->select("name")->from("organizations")->where("Id > 10")->limit(40,0)->get();
//        $result =$dboInstance->query($query);
//        $result->execute();
//        $allOrganizations=$result->fetchAll();
//        foreach($allOrganizations as $organization){
//            echo $organization['name']."\n";
//        }

//        $query=$dboInstance->select("name")->from("organizations")->where("created_on > '2013-02-10 00:00:00 '")->get();
//        $result =$dboInstance->query($query);
//        $result->execute();
//        $allOrganizations=$result->fetchAll();
//        foreach($allOrganizations as $organization){
//            echo $organization['name']."\n";
//        }

        $where=array();
        array_push($where,"Id > 10");
        array_push($where,"Id < 50");
        $query=$dboInstance->select("name")->from("organizations")->where($where)->orderBy("name","DESC")->get();
        $result =$dboInstance->query($query);
        $result->execute();
        $allOrganizations=$result->fetchAll();
        foreach($allOrganizations as $organization){
            echo $organization['name']."\n";
        }

    }

}

databaseOperations::dbOperations();


?>