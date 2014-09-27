<?php

class UserManagementController extends \BaseController {
    public function getIndex(){
        $date=new DateTime();
        return array("apikey"=>UUID::v4(),"v5-api"=>UUID::v5('1546058f-5a25-4334-85ae-e68f2a44bbaf', $date->getTimestamp()));
    }
    public function postIndex(){
        $validator = Validator::make(Input::all(), array(
            "company_name" => "required",
            "username" => "required|email",
            "password" => "required",
            "repeat_password" => "required",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }else{
            $date=new DateTime();
            $application=new ApplicationModel();
            $application->company_name=Input::get('company_name');
            $application->api_key=UUID::v5('1546058f-5a25-4334-85ae-e68f2a44bbaf', $date->getTimestamp());
            $application->save();

            $user=new User();
            $user->username=Input::get('username');
            $user->email=Input::get('username');
            $user->password=Hash::make(Input::get('password'));
            $user->application=$application->api_key;

            $user->save();

            $application->owner=$user->id;
            $application->save();

            return ProcessResponse::$success;
        }
    }
}