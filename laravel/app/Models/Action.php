<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model 
{

	protected $table = 'action';
    protected $primaryKey = 'f_action_id';
    protected $fillable = array('f_action_parent_id','f_action','f_action_name');
    private $errors;
    public $timestamps = false; 
    public function errors()
    {
        return $this->errors;
    }

}
