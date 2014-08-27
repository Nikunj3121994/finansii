<?php

class Order extends \Eloquent {
	protected $fillable = array('order_type','order_number','order_date','order_booking','company_code');
    public function operators(){
        return $this->belongsTo('Operator','operator_id');
    }
    public function companies(){
        return $this->belongsTo('Company','company_code','company_code');
    }
}