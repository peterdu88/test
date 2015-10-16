<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {

	//

    protected $table = "shipping";

    public function orderItems(){
        return  $this->belongsTo('App\Models\OrderItems','orderitem_id');
    }

}
