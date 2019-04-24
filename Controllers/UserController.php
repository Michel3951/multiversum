<?php

namespace Controllers;

use Classes\DatabaseHandler;
use Classes\Request;

class UserController
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
        $this->request = new Request();
    }

    public function view() {
        $contacts = $this->con->query('SELECT * FROM users');
        return $this->request->view('views.users', [
            'contacts' => $contacts
        ]);
    }
}