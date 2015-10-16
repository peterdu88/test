<?php namespace App\Models;

use Cartalyst\Sentinel\Activations\EloquentActivation;

class Activations extends EloquentActivation implements ActivationInterface{
	//

    protected $appends = [
        'code',
        'completed',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
