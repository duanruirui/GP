<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'admin_user';    
    protected $primaryKey = 'f_id';
    public $timestamps = false;
    protected $fillable = ['f_group_id','f_admin_user_realname','f_admin_user_name','f_admin_user_password','f_admin_user_email','f_admin_user_last_ip','f_admin_user_create_time','f_admin_user_last_login','f_admin_user_flag','f_action_id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getAuthPassword()
    {
    	return $this->f_admin_user_password;
    }
    
	public function getRememberTokenName()
    {
        return 'rememberToken';
    }
}
