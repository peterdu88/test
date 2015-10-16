<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;

/**
 * Class Vendors
 * @package App\Models
 */
class Vendors extends Model {

    protected $table = 'vendors';

    protected $fillable = ['name','phone','email','contact','fax','address','city','state','country','zipcode'];

    /**
     *
     */
    public function __construct(){}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OrderItems(){
        return $this->hasMany('App\Models\OrderItems');
    }

    /**
     * retriew the country code for vendor
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function countries(){
        return $this->belongsTo('App\Models\Countries','country_id');
    }
}
