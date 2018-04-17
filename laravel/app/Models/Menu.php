<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model 
{

	protected $table = 'menu';
    
    protected $primaryKey = 'f_menu_id';
    protected $fillable = array('f_menu_parent_id','f_action','f_menu_name','f_menu_url','f_menu_order','f_menu_flag');
    private $errors;
    public $timestamps = false;
    public function errors()
    {
        return $this->errors;
    }

}
