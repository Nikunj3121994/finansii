<?php

class Form extends \Eloquent {
    public function fields(){
        return $this->belongsToMany('Field');
    }
}