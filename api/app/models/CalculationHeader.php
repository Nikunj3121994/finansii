<?php

class CalculationHeader extends \Eloquent {
	protected $fillable = array('business_unit_id','calculation_number','document_number','partner_code',
                                    'calculation_date','calculation_ddo','calculation_booked','currency_code',
                                        'currency_value','calculation_type_code');
    public function __call($method, $parameters)
    {
        $return = parent::__call($method, $parameters);
        $user=Auth::getUser();
        if($method == 'query') {
            $tableName=(new self)->getTable();
            $return->join('applications',function($join) use ($user,$tableName){
                $join->on($tableName.".user",'=','user.id');
                $join->where('user.application', '=', $user->application);
                $join->select('user.id','user.application');
            });
        }
        return $return;
    }
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