<?php

class Article extends \Eloquent {
	protected $fillable = array('article_name','tariff_code','unit_id','pack','user');
	protected $visible = array('id','article_name','tariff_code','unit_id','pack','tariffs','units');
    public function scopeApp($query){
        $user=Auth::getUser();
        $tableName=(new self)->getTable();
        return $query->join('users',function($join) use ($user,$tableName){
            $join->on($tableName.".user",'=','users.id');
            $join->where('users.application', '=', $user->application);
        })->select("users.id as uid",$tableName.".*");
    }
    public function tariffs(){
        return $this->belongsTo('Tariff','tariff_code','id');
    }

    public function units(){
        return $this->belongsTo('Unit','unit_id','id');
    }
}