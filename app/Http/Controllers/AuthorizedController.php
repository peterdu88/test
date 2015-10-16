<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AuthorizedController extends Controller {

    protected $user, $users;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->users = Sentinel::getRoleRepository();
        $this->user = Sentinel::getUser();

    }
}