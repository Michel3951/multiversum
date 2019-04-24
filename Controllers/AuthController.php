<?php

namespace Controllers;

use Classes\Request;
use Classes\DatabaseHandler;

class AuthController
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
    }

    /*
    * Function to show the login page
    * @param $request - Request object - The request class
    */

    public function showLoginPage($request)
    {
        $request->view('views.auth.login', $request);
    }

    /*
    * Function to show the login page
    * @param $request - Request object - The request class
    */

    public function showRegistrationPage($request)
    {
        $request = new Request();
        $request->view('views.auth.register', $request);
    }
}