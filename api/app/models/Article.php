<?php

class Article extends \Eloquent {
	protected $fillable = array('article_name','tariff_code','unit_id','pack');
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
    public function tariffs(){
        return $this->belongsTo('Tariff','tariff_code','tariff_code');
    }

    public function units(){
        return $this->belongsTo('Unit','unit_id','id');
    }
}