<?php

class UserManagementController extends \BaseController {
    public function getIndex(){
        $date=new DateTime();
        return array("apikey"=>UUID::v4(),"v5-api"=>UUID::v5('1546058f-5a25-4334-85ae-e68f2a44bbaf', $date->getTimestamp()));
    }
}