<?php

class Tariff extends \Eloquent {
	protected $fillable = array('tariff_code','tariff_rate','tariff_name');
	protected $visible = array('id','tariff_code','tariff_rate','tariff_name');
}