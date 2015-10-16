<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

	//

    protected $table = "categories";
    protected $fillable = array('name','description');

    public function __construct(){}

    public function OrderItems(){
        return   $this->hasMany('App\Models\OrderItems');
    }
}
