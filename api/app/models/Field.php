<?php

class Field extends \Eloquent {
    public function config(){
        return $this->hasMany('FieldConfig');
    }
    public function forms(){
        return $this->belongsToMany('FormConfig');
    }
}