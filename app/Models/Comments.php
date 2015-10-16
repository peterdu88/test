<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

	//

    protected $table = "comments";

    protected $fillable = array('orderitem_id','content');

    public function __construct(){}

    public function orderItems(){
        return   $this->belongsTo('APP\Models\OrderItems','orderitem_id','comment_id');
    }
}
