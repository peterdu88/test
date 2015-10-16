<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    //
    protected $table = "orders";
    protected $fillable = ['id', 'user_id', 'specialinstruction', 'status'];

    //
    public function orderitems()
    {
        return $this->hasMany('App\Models\OrderItems','order_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getTotalOrderItemsAttribute()
    {
        //return $this->hasMany('App\Models\OrderItems','order_id')->where('order_id',$this->order_id)->count();
    }
}
