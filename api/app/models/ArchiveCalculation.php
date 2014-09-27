<?php

class ArchiveCalculation extends \Eloquent {
    protected $fillable = array('calculation_header_id','article_id','quantity','rabat','price_input1','tariff_rate_input',
        'tax_input','tax_output','price_input2','margin','price_output1','price_output2',
        'tariff_code','debit_credit');
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
    public function articles(){
        return $this->belongsTo('Article','article_id','id');
    }
}