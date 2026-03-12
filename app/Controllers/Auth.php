<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === 'admin')
        {
            session()->set('isAdmin', true);
            return redirect()->to('/admin/campaigns');
        }

        return redirect()->back()->with('error', 'Invalid login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}