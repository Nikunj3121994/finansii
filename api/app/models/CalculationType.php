<?php

class CalculationType extends \Eloquent {
	protected $fillable = array('calculation_type_code','calculation_type_name');
	protected $visible = array('id','calculation_type_code','calculation_type_name');
}