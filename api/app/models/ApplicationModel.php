<?php

class ApplicationModel extends \Eloquent {
    protected $fillable = array('id','company_name','owner','api_key');
    protected $visible = array('id','company_name','owner','api_key');
    protected $table='applications';
}