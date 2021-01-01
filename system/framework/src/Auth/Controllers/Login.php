<?php

namespace Systerm\Auth\Controllers;

class Login {
    /**
     * Login Constructor
     * 
     * @return void
     */
    private function __construct(){}

    /**
     * Login View
     */
    public static function view(){
        return view('auth.login');
    }
}