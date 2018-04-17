<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model 
{

	protected $table = 'group';
    
    protected $primaryKey = 'f_group_id';
    protected $fillable = array('f_group_name','f_group_describe','f_action_list');
    private $errors;
    public $timestamps = false;
    public function errors()
    {
        return $this->errors;
    }

}
