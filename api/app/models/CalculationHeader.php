<?php

class CalculationHeader extends \Eloquent {
	protected $fillable = array('business_unit_id','calculation_number','document_number','partner_code',
                                    'calculation_date','calculation_ddo','calculation_booked','currency_code',
                                        'currency_value','calculation_type_code');
    public function businessUnits(){
        return $this->belongsTo('BusinessUnit','business_unit_id','id');
    }
    public function partners(){
        return $this->belongsTo('Partner','partner_code','partner_code');
    }
    public function calculationTypes(){
        return $this->belongsTo('CalculationType','calculation_type_code','calculation_type_code');
    }
    public function currencies(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}