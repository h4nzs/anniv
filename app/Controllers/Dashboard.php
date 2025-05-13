<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            'username' => $session->get('username')
        ];

        return view('dashboard', $data);
    }
}
