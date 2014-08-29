<?php

class ExchangeRate extends \Eloquent {
    protected $fillable = array('exchange_date','currency_code','currency_value');
    public function currencies(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}