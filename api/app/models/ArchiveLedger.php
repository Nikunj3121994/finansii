<?php

class ArchiveLedger extends \Eloquent {
	protected $fillable = array(
        'company_code','order_id','account','sub_account',
        'date','document_number','document_desc','document_date',
        'booking_type','amount','currency_code','amount_currency'
    );
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
    public function company(){
        return $this->belongsTo('Company','company_code','company_code');
    }

    public function order(){
        return $this->belongsTo('Order','order_id','id');
    }
    public function accounts(){
        return $this->belongsTo('Account','account','account');
    }public function subAccount(){
        return $this->belongsTo('SubAccount','sub_account','id');
    }
    public function currencies(){
        return $this->belongsTo('Currency','currency_code','id');
    }
}