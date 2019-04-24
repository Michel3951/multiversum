<?php

namespace Controllers;

use Classes\DatabaseHandler;

class ContactController
{
    public function __construct()
    {
        $this->con = new DatabaseHandler();
    }

    public function show($request)
    {
        $request->view('views.contact.index');
    }

    public function handle($request)
    {
        $subject = "Nieuw Bericht - Multiversum.com";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $message = "
        <html>
        <head>
            <title>Nieuw Bericht - Multiversum.com</title>
        </head>
        <body>
            <a href='http://multiversum.michel3951.com'><img src='http://multiversum.michel3951.com/views/images/mvm.png' alt='logo' style='max-width: 200px;'></a>
            <p>Er is een nieuw bericht binnen van het contact formulier.</p>
            <p>Naam: " . $request->input('name') . "</p>
            <p>E-Mail adres: " . $request->input('email') . "</p>
            <p>Bericht: " . $request->input('message') . "</p>
            </body>
        </html>";
        mail('michel39511@gmail.com', $subject, $message, implode("\r\n", $headers));
        $request->view('views.contact.index');
    }
}