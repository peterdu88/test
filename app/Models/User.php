<?php

namespace App\Models;
use Cartalyst\Sentinel\Activations\EloquentActivation;
use Illuminate\Auth\Authenticatable;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Activations;


class User extends EloquentUser implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
//        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'password_confirmation', 'remember_token'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(){
       return $this->hasMany('App\Models\Orders');
    }

    public function orderItems()
    {
        return $this->hasManyThrough('App\Models\orderItems','App\Models\Orders','user_id','order_id');
    }

    /**
     * create related approval information (only for Managers or Administrator with approval permissions)
     *
     * @return mixed
     */
    public function approval(){
        return $this->hasMany('App\Models\Approval');
    }

    /**
     * Description: Returns an array containing all users.
     * @return mixed
     */
    static function findAll()
    {
//        return User::all();

        return self::createModel()->newQuery()->get()->all();
    }

    /**
     * Returns all users with access to
     * a permission(s).
     *
     * @param  string|array  $permissions
     * @return array
     */
    static function findAllWithAccess($permissions)
    {
        return array_filter(self::findAll(), function($user) use ($permissions)
        {
            return $user->hasAccess($permissions);
        });
    }
    /**
     * Returns all users with access to
     * any given permission(s).
     *
     * @param  array  $permissions
     * @return array
     */
    static function findAllWithAnyAccess(array $permissions)
    {
        return array_filter(self::findAll(), function($user) use ($permissions)
        {
            return $user->hasAnyAccess($permissions);
        });
    }

    /**
     *  combine the first name and last name
     * Description:
     * @return string
     */
    public function getUserFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
//
//    public function getUserFullNameIdAttribute()
//    {
//        return array_filter(self::findAll(), function($user){
//            return $user->userFullName = $user->first_name .' '. $user->last_name;
//        });
//    }
}
