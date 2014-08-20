<?php

class Currency extends \Eloquent {
	protected $fillable = array('currency_shrt_name','currency_name',
        'currency_country','currency_unit');
    public function exchangeRates(){
        return $this->hasMany('ExchangeRate','currency_code','id');
    }
}