<?php

namespace App\Models;

use Cartalyst\Sentinel\Roles\EloquentRole;

class Roles extends EloquentRole{
	//
/*    protected $table = 'roles';
    protected $fillable = ['name','slug','permissions'];*/


/*    public  function users(){
        return $this->belongsToMany('App\Models\User', 'role_users','user_id','role_id')->withTimestamps();
    }*/

/*    public function permissions(){
        return $this->hasMany('App\Models\Permissions')->withPivot();
    }
*/
/*    public function getRoleListAttribute(){
      return $this->lists('id');
    }*/

}
