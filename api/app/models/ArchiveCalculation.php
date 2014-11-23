<?php

class ArchiveCalculation extends \Eloquent {
    protected $fillable = array('id','calculation_header_id','article_id','quantity','rabat','price_input1','tariff_rate_input',
        'tax_input','tax_output','price_input2','margin','price_output1','price_output2',
        'tariff_code','debit_credit','user');
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        })->select("users.id as uid",$tableName.".*");
    }
    public function articles(){
        return $this->belongsTo('Article','article_id','id');
    }
}