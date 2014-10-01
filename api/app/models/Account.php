<?php

class Account extends \Eloquent {
	protected $fillable = array('account','account_name','account_type','sub_account_code');
	protected $visible = array('id','account','account_name','account_type','sub_account_code','sub-accounts');
    public function subAccounts(){
        return $this->belongsTo('SubAccount','sub_account_code','sub_account_code');
    }
}