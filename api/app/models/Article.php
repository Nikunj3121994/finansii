<?php

class Article extends \Eloquent {
	protected $fillable = array('article_name','tariff_code','unit_id','pack');
    public function tariffs(){
        return $this->belongsTo('Tariff','tariff_code','tariff_code');
    }

    public function units(){
        return $this->belongsTo('Unit','unit_id','id');
    }
}