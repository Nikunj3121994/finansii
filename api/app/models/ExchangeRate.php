<?php

class ExchangeRate extends \Eloquent {
    protected $fillable = array('exchange_date','currency_code','currency_value','user');
    protected $visible = array('id','exchange_date','currency_code','currency_value','currencies');
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        })->select("users.id as uid",$tableName.".*");
    }
    public function currencies(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}