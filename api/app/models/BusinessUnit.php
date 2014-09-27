<?php

class BusinessUnit extends \Eloquent {
	protected $fillable = array('company_code','business_unit_code','business_unit_name',
        'business_unit_type','business_unit_account','business_unit_address');
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
    public function companies(){
        return $this->belongsTo('Company','company_code','company_code');
    }
}