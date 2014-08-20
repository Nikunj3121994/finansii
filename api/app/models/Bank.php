<?php

class Bank extends \Eloquent {
	protected $fillable = array('bank_bic','bank_name','bank_based','bank_account','bank_code');
    public function companies(){
        return $this->belongsToMany('Company')->withPivot('bank_account','rang');
    }
}