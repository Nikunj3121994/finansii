<?php

class BusinessUnit extends \Eloquent {
	protected $fillable = array('id','company_code','business_unit_code','business_unit_name',
        'business_unit_type','business_unit_account','business_unit_address','user');
    protected $visible = array('id','company_code','business_unit_code','business_unit_name',
        'business_unit_type','business_unit_account','business_unit_address','companies');
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        })->select("users.id as uid",$tableName.".*");
    }
    public function companies(){
        return $this->belongsTo('Company','company_code','id');
    }
}