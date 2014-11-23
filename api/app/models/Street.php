<?php

class Street extends \Eloquent {
	protected $fillable = array('street_code','street_name','settlement_code');
	protected $visible = array('id','street_code','street_name','settlement_code','settlements');
    public function settlements(){
        return $this->belongsTo('Settlement','settlement_code','id');
    }
}