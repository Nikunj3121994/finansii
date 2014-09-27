<?php

class Order extends \Eloquent {
	protected $fillable = array('order_type','order_number','order_date','order_booking','company_code');
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        });
    }
    public function operators(){
        return $this->belongsTo('Operator','operator_id');
    }
    public function companies(){
        return $this->belongsTo('Company','company_code','company_code');
    }
    public function ledgers(){
        return $this->hasMany('Ledger','order_id','id');
    }
}