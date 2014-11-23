<?php

class Operator extends \Eloquent {
	protected $fillable = array('id','operator_name','operator_rang','operator_pass','operator_pass','operator_telephone','operator_mail');
    public function orders(){
        return $this->hasMany('Order');
    }
}