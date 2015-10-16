<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model {

	//

    protected $table = 'payments';
    protected $fillable = ['name','description','status'];

    public function __construct(){}


    /**
     *  get related order items by this payment.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function orderItems(){
        return $this->belongsToMany('App\Models\OrderItems','orderitem_payment','orderitem_id','payment_id')->withTimestamps();
    }

}
