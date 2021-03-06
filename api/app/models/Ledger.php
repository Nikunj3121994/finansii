<?php

class Ledger extends \Eloquent {
	protected $fillable = array(
        'id','company_code','order_id','account','sub_account',
        'date','document_number','document_desc','document_date',
        'booking_type','amount','currency_code','amount_currency','user'
    );
    protected $visible = array(
        'id','company_code','order_id','account','sub_account',
        'date','document_number','document_desc','document_date',
        'booking_type','amount','currency_code','amount_currency',
        'company','order','accounts','sub-account','currencies'
    );
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        })->select("users.id as uid",$tableName.".*");
    }
    public function company(){
        return $this->belongsTo('Company','company_code','id');
    }

    public function order(){
        return $this->belongsTo('Order','order_id','id');
    }
    public function accounts(){
        return $this->belongsTo('Account','account','id');
    }public function subAccount(){
        return $this->belongsTo('SubAccount','sub_account','id');
    }
    public function currencies(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}