<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use DB;

class OrderItems extends Model {

    protected $table = 'orderitems';
    protected $fillable = ['id', 'name', 'vendor_id','order_id','category_id','description', 'quantity', 'estimatedprice','estimatedtotal','fixedprice','fixedtotal','status','shipping_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function shipping(){
        return $this->hasOne('App\Models\Shipping');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(){
        return $this->belongsToMany('App\Models\Payments','orderitem_payment')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(){
        return $this->hasMany('App\Models\Comments');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vendor(){
        return $this->belongsTo('App\Models\Vendors','vendor_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(){
        return $this->belongsTo('App\Models\Orders');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function category(){
        return $this->belongsTo('App\Models\Categories');
    }

    public function approval(){
        return $this->belongsToMany('App\Models\Approvals','orderitem_approval','approval_id','orderitem_id')->withTimestamps();
    }
}
