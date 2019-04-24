<?php

namespace Classes;

use Classes\HandleAuthorization;
use Classes\DatabaseHandler;

class Request
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
    }

    /*
     * Function to attempt to log an user in
     * @param $username - string - The username that will login
     * @param $password - string - The password that will be used to login
     */

    public function login($username, $password)
    {
        $controller = new HandleAuthorization();
        $controller->handle($username, $password);
    }

    /*
     * Function to logout the currently logged in user
     */

    public function logout()
    {
        session_destroy();
    }

    /*
     * Function to create a pagination list
     * @param $count - integer - The total number of items to paginate
     * @param $length - integer - The length of a page
     */

    public function paginate($count, $length)
    {
        //Check if there is a page in the $_GET
        $page = intval($this->query('page'));
        print '<nav aria-label="pagination">
                <ul class="pagination">';
        //Loop over the amount of pages
        for ($i = 0; $i < ceil($count / $length); $i++) {
            //Because php is autistic with number to string concats
            $cur = $i + 1;
            if ($page && $page === $i) {
                print "<li class='page-item active'><a class='page-link' href='?page=$i'>$cur</a></li>";
            } else if (!$page && $i === 0) {
                print "<li class='page-item active'><a class='page-link' href='?page=$i'>$cur</a></li>";
            } else {
                print "<li class='page-item'><a class='page-link' href='?page=$i'>$cur</a></li>";
            }
        }
        print '</ul>
              </nav>';
    }

    /*
     * Function to go to the previous page
     */

    public function back()
    {
        print '<script>window.location = document.referrer</script>';
    }

    /*
     * Function to extract data from $_GET
     * @param $string - string - The string that should be extracted
     */

    public function query($string)
    {
        if (!isset($_GET[$string])) return null;
        return $_GET[$string];
    }

    /*
     * Function to display an error code, with an optional message
     * @param $code - integer - The HTTP status code
     * @param $message - string - The message that should be displayed
     */

    public function respondWithStatusCode($code, $message = false)
    {
        //Check if there is a template for this error code
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/views/errors/$code.php")) {
            include $_SERVER['DOCUMENT_ROOT'] . "/views/errors/$code.php";
            return;
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . "/views/errors/default.php";
            return;
        }
    }

    /*
     * Function to get the role of an user
     */

    public function getRole()
    {
        $role = $this->con->query('SELECT role FROM users WHERE id = ?', [$this->session('user_id')])[0] ?? null;
        return $role['role'] ?? null;
    }

    /*
     * Function to get all data from $_POST
     */

    public function allInputs()
    {
        if (!isset($_POST)) return null;
        $result = array();
        foreach ($_POST as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }

    /*
     * Function to get a single item from $_POST
     * @param $string - string - The item that should be extracted
     */

    public function input($string)
    {
        return $_POST[$string] ?? null;
    }

    /*
     * Function to get a single item from $_SESSION
     * @param $string - string - The item that should be extracted
     */

    public function session($string)
    {
        if (!isset($_SESSION[$string])) return null;
        return $_SESSION[$string];
    }

    /*
     * Function to retrieve the HTTP method that was used in a request
     */

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /*
     * Function to get the current URL
     */

    public function getURL()
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }

    /*
     * Function to check if an user is logged in
     */

    public function isLoggedIn()
    {
        if (!isset($_SESSION)) return false;
        if (!array_key_exists('auth', $_SESSION)) return false;
        return $_SESSION['auth'] > 0 ? true : false;
    }

    /*
     * Function to redirect an user to a web page / site
     * @param $path - string - The URL that the user should be redirected to
     */

    public function redirect($path)
    {
        header("Location: $path");
    }

    /*
     * Function to load the page's content
     * @param $path - string - The path to this view
     * @param $data - array - An array with variables that can be used on the page
     */

    public function view($path, $data = false)
    {
        //Replaces the given path to ./Path/to/file.php and loads the view
        $path = preg_replace('/\.+/', '/', $path);
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
        $path .= '.php';
        return include $path;
    }
}