<?php

class Field extends \Eloquent {
    protected $fillable=array("name","visible","required","edit");
    protected $hidden=array("created_at","id","updated_at");
    public function property(){
        return $this->hasMany('FieldConfig');
    }
    public function forms(){
        return $this->belongsToMany('FormConfig');
    }
}