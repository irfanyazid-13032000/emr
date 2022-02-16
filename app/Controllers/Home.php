<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->m_site = new \App\Models\M_site();
        $param = [2, 6, 1241, 0];
        $data = $this->m_site->get_navigation_user_by_parent($param);
        return view('page/dashboard');
        var_dump($data);
    }
}
