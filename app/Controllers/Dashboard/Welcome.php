<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;

class Welcome extends BaseController
{
    public function index()
    {
        return view('page/dashboard');
    }
}
