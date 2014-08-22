<?php

class FormConfig extends \Eloquent {
    protected $fillable=array("name","edit","delete","add");
    protected $hidden=array("created_at","id","updated_at");
    public function fields(){
        return $this->hasMany('Field');
    }
}