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
    public function accounts(){
        return $this->belongsTo('Account','account','id');
    }public function subAccount(){
        return $this->belongsTo('SubAccount','sub_account','id');
    }
    public function currencies(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}