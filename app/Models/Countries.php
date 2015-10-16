<?php namespace App\Models;
/**
 * Created by PhpStorm.
 * User: FZB
 * Date: 10/5/2015
 * Time: 3:00 PM
 */


class Countries extends \Webpatser\Countries\Countries{


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendors(){
       return $this->hasMany('App\Models\Vendors');
    }
}