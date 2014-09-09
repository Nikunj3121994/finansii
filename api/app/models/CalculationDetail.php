<?php

class CalculationDetail extends \Eloquent {
    protected $fillable = array('calculation_header_id','article_id','quantity','rabat','price_input1','tariff_rate_input',
        'tax_input','tax_output','price_input2','margin','price_output1','price_output2',
        'tariff_code','debit_credit');
    public function articles(){
        return $this->belongsTo('Article','article_id','id');
    }
}