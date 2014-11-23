<?php

class Partner extends \Eloquent {
	protected $fillable = array('partner_code','partner_name','partner_address','municipality_code',
                                    'settlement_code','street_code','telephone1','telephone2','fax',
                                         'mail','owner','authorized','activity','id_number','tax_code','tax_payer','user');
    protected $visible = array('id','partner_code','partner_name','partner_address','municipality_code',
                                    'settlement_code','street_code','telephone1','telephone2','fax',
                                         'mail','owner','authorized','activity','id_number','tax_code','tax_payer',
                                            'municipalities','settlements','streets');
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        })->select("users.id as uid",$tableName.".*");
    }
    public function municipalities(){
        return $this->belongsTo('Municipality','municipality_code','id');
    }
    public function settlements(){
        return $this->belongsTo('Settlement','settlement_code','id');
    }
    public function streets(){
        return $this->belongsTo('Street','street_code','id');
    }
}