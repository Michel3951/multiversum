<?php

namespace Classes;

use Classes\Request;
use Classes\DatabaseHandler;

class HandleAuthorization
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
        $this->request = new Request();
    }

    /*
     * Function to validate a login request
     * @param $username - string - The username that will login
     * @param $password - string - The password that is used in the login
     */

    public function handle($username, $password)
    {
        //Retrieve the password hash from the database
        $passwordHash = $this->con->query('SELECT password FROM users WHERE name = ? LIMIT 1', [$username])[0];
        if (!array_key_exists('password', $passwordHash)) {
            //If there is no password returned, the user does not exist
            $this->request->redirect('/inloggen?username=Er is geen gebruiker met deze naam.');
            return;
        }
        if (password_verify($password, $passwordHash['password'])) {
            //If the password hash matches the $password parameter, the login was successful and the auth session part will be initiated
            $_SESSION['auth'] = 1;
            $id = $this->con->query('SELECT id FROM users WHERE name = ?', [$username])[0];
            $_SESSION['user_id'] = $id['id'];
            $_SESSION['role'] = $this->request->getRole() ?: 1;
            $this->request->redirect('/');
            return;
        } else {
            //If the password hash does not match the $password parameter, return with an error
            $this->request->redirect('/inloggen?password=Het ingevoerde wachtwoord is onjuist.');
        }
    }

    /*
     * Function to create a new account
     * @param $request - Request object - The request class
     */

    public function handleRegistration($request)
    {
        //Check if the email or username is already used
        if ($this->isEmailUsed($request->input('email'))) return $request->redirect('/registreren?email=Dit email adres is al in gebruik.');
        if ($this->isUsernameUsed($request->input('username'))) return $request->redirect('/registreren?username=Deze gebruikersnaam is al in gebruik.');
        //Check if the password matches the second password
        if ($request->input('password') != $request->input('password-verify')) return $request->redirect('/registreren?password-verify=De wachtwoorden komen niet overeen.');
        //Extract all $_POST data
        $post = $request->allInputs();
        $array = [
            $post['username'],
            $post['first-name'],
            $post['middle-name'],
            $post['last-name'],
            password_hash($post['password'], PASSWORD_BCRYPT),
            $post['email']
        ];
        //Create an account
        $this->con->createAccount($array);
        //Retrieve the accounts ID
        $id = $this->con->query('SELECT id FROM users WHERE name = ?', [$post['username']]);
        //Initiate auth session
        $_SESSION['auth'] = 1;
        $_SESSION['user_id'] = $id[0]['id'];
        $this->request->redirect('/');
    }

    /*
     * Function to check if an email address is already used
     * @param $needle - string - The email address to check
     */

    private function isEmailUsed($needle)
    {
        $email = $this->con->query('SELECT email FROM users WHERE email = ?', [$needle]);
        return $email ? true : false;
    }

    /*
    * Function to check if an username is already used
    * @param $needle - string - The username to check
    */

    private function isUsernameUsed($needle)
    {
        $name = $this->con->query('SELECT name FROM users WHERE name = ?', [$needle]);
        return $name ? true : false;
    }
}