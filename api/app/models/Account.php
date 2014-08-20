<?php

class Account extends \Eloquent {
	protected $fillable = array('account_name','account_type','sub_account_code');
    public function subAccounts(){
        return $this->belongsTo('SubAccount','sub_account_code','sub_account_code');
    }
}