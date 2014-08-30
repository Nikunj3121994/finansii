<?php
class ProcessResponse {
    public static $error=array("code"=>4001,"msg"=>"Path not found");
    public static $success=array("code"=>0,"msg"=>"Successful response");
    public static function process($data){
           if($data){
               if(sizeof($data)>0){
                    return array("body"=>$data,"error"=>ProcessResponse::$success);
               }
               else {
                   return array("body"=>array(),"error"=>ProcessResponse::getError(4000,"Resource not found"));
               }
           }else  return array("body"=>array(),"error"=>ProcessResponse::getError(4000,"Resource not found"));
    }
    public static function processReport($body,$header){
        if($body){
            if(sizeof($body)>0){
                return array("body"=>$body,"header"=>$header,"error"=>ProcessResponse::$success);
            }
            else {
                return array("body"=>array(),"header"=>$header,"error"=>ProcessResponse::getError(4000,"Resource not found"));
            }
        }else  return array("body"=>array(),"header"=>$header,"error"=>ProcessResponse::getError(4000,"Resource not found"));
    }
    public static function getError($code,$msg){
        return array("code"=>$code,"msg"=>$msg);
    }
}