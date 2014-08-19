<?php

class Municipality extends \Eloquent {
	protected $fillable = array('municipality_code','municipality_name','municipality_id');
    public function settlements(){
        return $this->hasMany('Settlement','');
    }
}