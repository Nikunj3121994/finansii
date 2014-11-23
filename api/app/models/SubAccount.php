<?php

class SubAccount extends \Eloquent {
	protected $fillable = array('id','sub_account_code','sub_account_name','sub_account_table');
	protected $visible = array('id','sub_account_code','sub_account_name','sub_account_table','accounts');
    public function accounts(){
        return $this->hasMany('Account');
    }
}