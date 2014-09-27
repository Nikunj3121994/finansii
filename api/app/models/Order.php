<?php

class Order extends \Eloquent {
	protected $fillable = array('order_type','order_number','order_date','order_booking','company_code');
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