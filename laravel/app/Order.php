<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'f_order_id';
    private $errors;
    public $timestamp = false;
    public function errors(){
    	return $this->errors;
    }
}
