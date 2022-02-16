<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{



    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $MAccount = new \App\Models\M_account();
        $login = $MAccount->get_user_login($this->request->getVar('username'), $this->request->getVar('password'), 2, 6);
        // var_dump($login);
        // die();
        if ($login) {
            // simpan session
            // redirect home
            $user_id = $MAccount->get_user_detail_by_username([$this->request->getVar('username'), 6, 2])['user_id'];
            session()->set([
                'username' => $this->request->getVar('username'),
                'role_id' => 2,
                'portal_id' => 6,
                'user_id' => $user_id
            ]);
            return redirect()->to(base_url('dashboard/welcome'));
        } else {
            session()->setFlashdata('failed', 'username atau password salah');
            return redirect()->to(base_url('auth'));
        }
    }

    public function logout()
    {
        session()->remove('username', 'role_id', 'portal_id', 'user_id');
        return redirect()->to(base_url('auth'));
    }
}
