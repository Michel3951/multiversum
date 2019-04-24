<?php

namespace Controllers;

use Classes\Request;
use Classes\DatabaseHandler;

class AdminController
{
    public function __construct()
    {
        $request = new Request();
        if (!$request->getRole()) {
            $request->respondWithStatusCode(403, 'U moet ingelogd zijn als admin om deze pagina te bekijken.');
            exit;
        } else if ($request->getRole() < 5) {
            $request->respondWithStatusCode(403, 'U moet admin zijn om deze pagina te bekijken.');
            exit;
        }
        $this->con = new DatabaseHandler();
    }

    /*
     * Function to show the admin dashboard
     * @param $request - Reques tobject - The request class
     */

    public function showDashboard($request)
    {
        $request->view('views.backend.dashboard', $request);
    }
}