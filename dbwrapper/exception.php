<?php
  class myException extends Exception {
      public function error(){
          $error=$this->message;
          return $error;
      }
  }

?>