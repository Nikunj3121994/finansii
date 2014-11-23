<?php

class Account extends \Eloquent {
	protected $fillable = array('account','account_name','account_type','sub_account_code');
	protected $visible = array('id','account','account_name','account_type','sub_account_code','sub-accounts');
    public function subAccounts(){
        return $this->belongsTo('SubAccount','id','sub_account_code');
    }
}