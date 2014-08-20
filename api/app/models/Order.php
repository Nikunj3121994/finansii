<?php

class Order extends \Eloquent {
	protected $fillable = array('order_type','order_number','order_date','order_booking','operator_id');
    public function operators(){
        return $this->belongsTo('Operator','operator_id');
    }
}