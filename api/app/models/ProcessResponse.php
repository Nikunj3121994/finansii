<?php
class ProcessResponse {
    public static $error=array("code"=>4001,"msg"=>"Path not found");
    public static $success=array("code"=>0,"msg"=>"Successful response");
    public static function process($data){
           if($data){
               if(sizeof($data)>0){
                   if(sizeof($data)==1) return array("body"=>$data[0],"error"=>ProcessResponse::$success);
                   else return array("body"=>$data,"error"=>ProcessResponse::$success);
               }
               else {
                   return ProcessResponse::getError(4000,"Resource not found");
               }
           }else  return ProcessResponse::getError(4000,"Resource not found");
    }
    public static function getError($code,$msg){
        return array("code"=>$code,"msg"=>$msg);
    }
}