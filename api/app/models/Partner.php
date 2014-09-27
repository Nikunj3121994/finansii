<?php

class Partner extends \Eloquent {
	protected $fillable = array('partner_code','partner_name','partner_address','municipality_code',
                                    'settlement_code','street_code','telephone1','telephone2','fax',
                                         'mail','owner','authorized','activity','id_number','tax_code','tax_payer');
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
    public function municipalities(){
        return $this->belongsTo('Municipality','municipality_code','municipality_code');
    }
    public function settlements(){
        return $this->belongsTo('Settlement','settlement_code','settlement_code');
    }
    public function streets(){
        return $this->belongsTo('Street','street_code','street_code');
    }
}