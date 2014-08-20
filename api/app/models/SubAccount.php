<?php

class SubAccount extends \Eloquent {
	protected $fillable = array('sub_account_code','sub_account_name','sub_account_table');
    public function accounts(){
        return $this->hasMany('Account');
    }
}