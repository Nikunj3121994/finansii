<?php

class Municipality extends \Eloquent {
	protected $fillable = array('id','municipality_code','municipality_name');
	protected $visible = array('id','municipality_code','municipality_name','settlements');
    public function settlements(){
        return $this->hasMany('Settlement','');
    }
}