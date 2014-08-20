<?php

class Ledger extends \Eloquent {
	protected $fillable = array(
        'company_code','order_id','account','sub_account',
        'date','document_number','document_desc','document_date',
        'booking_type','amount','currency_code','amount_currency'
    );

    public function company(){
        return $this->belongsTo('Company','company_code','company_code');
    }

    public function order(){
        return $this->belongsTo('Order','order_id','id');
    }
    public function account(){
        return $this->belongsTo('Account','sub_account','id');
    }
    public function currency(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}