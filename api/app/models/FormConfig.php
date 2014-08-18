<?php

class FormConfig extends \Eloquent {
    public function fields(){
        return $this->belongsToMany('Field');
    }
}