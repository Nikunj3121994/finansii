<?php

class Field extends \Eloquent {
    protected $fillable=array("name","visible","required","edit");
    public function property(){
        return $this->hasMany('FieldConfig');
    }
    public function forms(){
        return $this->belongsToMany('FormConfig');
    }
}