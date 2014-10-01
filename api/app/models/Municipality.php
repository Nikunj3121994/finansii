<?php

class Municipality extends \Eloquent {
	protected $fillable = array('municipality_code','municipality_name','municipality_id');
	protected $visible = array('id','municipality_code','municipality_name','municipality_id','settlements');
    public function settlements(){
        return $this->hasMany('Settlement','');
    }
}