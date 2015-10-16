<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approvals extends Model {

	//
    protected $table = "approvals";
    public $timestamps = false;
    protected $fillable =['name','status'];


    public function orderitems(){
        return   $this->belongsToMany('App\Models\OrderItems','orderitem_approval','orderitem_id','approval_id')->withTimestamps();
    }

    public function users(){
        return  $this->belongsTo('users','approval_user_id');
    }
}
