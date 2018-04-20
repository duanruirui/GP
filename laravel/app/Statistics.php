<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    protected $table = 'statistics';
    protected $primaryKey = 'f_order_id';
    private $errors;
    public $timestamp = false;
    public function errors(){
    	return $this->errors;
    }
}
