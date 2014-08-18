<?php

class FormConfig extends \Eloquent {
    protected $fillable=array("name","edit","delete","add");
    public function fields(){
        return $this->belongsToMany('Field');
    }
}