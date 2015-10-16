<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialInstruction extends Model {

	//

    protected $table = "specialinstruction";

    public function __construct(){

    }

    public function order(){
        return  $this->belongsTo('App\Models\Orders','order_id');
    }
}
