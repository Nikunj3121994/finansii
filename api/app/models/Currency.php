<?php

class Currency extends \Eloquent {
	protected $fillable = array('id','currency_shrt_name','currency_name',
        'currency_country','currency_unit');
    protected $visible = array('id','currency_shrt_name','currency_name',
        'currency_country','currency_unit','exchange-rates');
    public function exchangeRates(){
        return $this->hasOne('ExchangeRate','currency_code','id');
    }
}