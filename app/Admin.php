<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Admin extends Authenticatable
{
   public $timestamps = false;
   protected $fillable=[
       'admin_email','admin_password','admin_name'
   ];
   protected $primaryKey = 'admin_id';
   protected $table = 'tbl_admin';

    public function roles(){
        return $this->belongsToMany('App\Roles');
    }
    public function Check_login()
    {
       return $this->admin_id;
    }
   public function getAuthPassword()
   {
       return $this->admin_password;
   }
    public function hasAnyRoles($roles){

       return null !== $this->roles()->WhereIn('name',$roles)->first();
    }
    public function hasRole($role){
        return null !== $this->roles()->Where('name',$role)->first();
    }
}
