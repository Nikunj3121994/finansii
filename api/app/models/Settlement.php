<?php

class Settlement extends \Eloquent {
	protected $fillable = array("settlement_code",'settlement_name','ptt_code','municipality_code');
    public function municipalities(){
        return $this->belongsTo('Municipality','municipality_code','municipality_code');
    }
}