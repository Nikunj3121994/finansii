<?php

class Unit extends \Eloquent {
	protected $fillable = array('unit_name','unit_desc');
	protected $visible = array('id','unit_name','unit_desc');
}