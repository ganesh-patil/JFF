<?php
class databaseOperations{
    private static $connectionObject;
    private function __construct(){

    }

    public static function getObject(){
        if (self::$connectionObject === null) {
            $connectionObject= new  databaseOperations();
        }
        return $connectionObject;
    }

}
//$object=databaseOperations::getObject();
//$object2=databaseOperations::getObject();
//$object->ganesh="object one initialized";
//print_r($object);
//print_r($object2);


?>