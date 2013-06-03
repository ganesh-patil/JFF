<?php
class databaseOperations{
    private static $connectionObject;
    private $select='';
    private $from='';
    private $where='';
    private $orderby='';
    private $groupby='';
    private $limit='';
    private $delete='';
    private $host="localhost";
    private  $username="root";
    private $password="ganesh";
    private $dbname="jff";
    private function __construct(){

    }

    public function select($fields=null){
        $this->select=' ';
        if (is_array($fields) && !empty($fields)){
            foreach($fields as $field){
                    $this->select.=$field.', ';
            }
            $this->select=trim($this->select, ", ").' ';
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
                $this->from.=$table.', ';
            }
            $this->from=trim($this->from, ", ").' ';
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
        return $this;
    }

    function groupBy ($fieldName ){
         $this->groupby=' ';
        if($fieldName){
            $this->groupby="GROUP BY ".$fieldName." ";
        }

        return $this;
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
               self::$connectionObject = new PDO('mysql:host=localhost;dbname=jff', 'root', 'ganesh');
               self::$connectionObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           return self::$connectionObject;
       }
       catch (PDOException $e){
           print $e->getMessage ();
       }


   }

    function get (){
        $query="SELECT ".$this->select."FROM ".$this->from."WHERE ".$this->where.$this->orderby.$this->groupby." ".$this->limit;
        return $query;
    }

     function query ($query) {
         print_r($query);die;
         $dbo=$this->getInstance();
         return $dbo->prepare($query);
     }

    function getResult($result){
        $result->execute();
        return $result->fetchAll();
    }
    function displayOrganizations($allOrganizations){
         foreach($allOrganizations as $organization){
         echo $organization['name']."\n";
    }
   }

    function displayOrganizationDetails($allOrganizations){
        foreach($allOrganizations as $organization){
            echo $organization['id']."\n";
            echo $organization['name']."\n";
            echo $organization['created_on']."\n";
        }
    }

    function delete($tableName, $conditions=null ){
        $delete='';
        $where=" WHERE 1=1 ";
        if($tableName){
            $delete .= "DELETE * FROM ".$tableName." ";
            if(!empty($conditions)){
                if(is_array($conditions)){
                    foreach($conditions as $condition){
                      $where .= " AND ".$condition." ";
                    }
                }
                else {
                    $where .= "  AND ".$conditions." ";
                }
            }
            $delete .= $where;
        }
        return $delete;
    }

    function update($tableName,$values,$conditions=null){
        $update='';
        $where=" WHERE 1=1 ";
        $set_value='';
        if($tableName && !empty($values)){
            $update="UPDATE table ".$tableName." SET ";
            if(is_array($values)){
                foreach ($values as $value){
                    $set_value .= $value." ";
                }
            }
            else{
                $set_value .= $values." ";
            }
            if(!empty($conditions)){
                if(is_array($conditions)){
                    foreach($conditions as $condition){
                        $where .= " AND ".$condition." ";

                    }
                }
                else {
                    $where .= "  AND ".$conditions." ";
                }
            }
            $update.= $set_value.$where;
        }
        return $update;
    }
    function dbOperations(){
        $dboInstance=new databaseOperations();
//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("name")->from("organizations")->where()->get()));
//        $dboInstance->displayOrganizations($allOrganizations);


//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("name")->from("organizations")->where("Id > 10")->limit(10)->get()));
//        $dboInstance->displayOrganizations($allOrganizations);
//
//
//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("name")->from("organizations")->where("Id > 10")->limit(40,0)->get()));
//        $dboInstance->displayOrganizations($allOrganizations);


//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("name")->from("organizations")->where("created_on > '2013-02-10 00:00:00 '")->get()));
//        $dboInstance->displayOrganizations($allOrganizations);

//        $where=array();
//        array_push($where,"Id > 10");
//        array_push($where,"Id < 50");
//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("name")->from("organizations")->where($where)->orderBy("name","DESC")->get()));
//        $dboInstance->displayOrganizations($allOrganizations);


//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("*")->from("organizations")->where("Id=70")->get()));
//        $dboInstance->displayOrganizationDetails($allOrganizations);

//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("*")->from("organizations")->where("name='Org Name 30'")->get()));
//        $dboInstance->displayOrganizationDetails($allOrganizations);
//
//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select("*")->from("users")->where("organisation_id = 30")->get()));
//        $dboInstance->displayOrganizationDetails($allOrganizations);
//
//        $select=array();
//        array_push($select,"COUNT( u.id ) AS count");
//        array_push($select,"o.name");
//        $from=array();
//        array_push($from,"`users` u");
//        array_push($from,"`organizations` o");
//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->select($select)->from($from)->where("u.organisation_id = o.id")->groupBy("o.name")->get()));
//        foreach($allOrganizations as $organization){
//            echo $organization['count']."\n";
//            echo $organization['name']."\n";
//        }

//        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->delete('users',"city ='city7'")));

        $update_values=array();
        array_push($update_values,"fname = 'abc'");
        array_push($update_values,"lname = 'xyz'");
        $allOrganizations=$dboInstance->getResult($dboInstance->query($dboInstance->update('users',$update_values,"city ='city7'")));



    }

}

databaseOperations::dbOperations();


?>