<?php

class Street extends \Eloquent {
	protected $fillable = array('street_code','street_name','settlement_code');
    public function settlements(){
        return $this->belongsTo('Settlement','settlement_code','settlement_code');
    }
}