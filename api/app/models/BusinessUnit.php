<?php

class BusinessUnit extends \Eloquent {
	protected $fillable = array('company_code','business_unit_code','business_unit_name',
        'business_unit_type','business_unit_account','business_unit_address');
    public function companies(){
        return $this->belongsTo('Company','company_code','company_code');
    }
}