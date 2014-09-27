<?php

class ApplicationModel extends \Eloquent {
    protected $fillable = array('company_name','owner','api_key');
    protected $table='applications';
}