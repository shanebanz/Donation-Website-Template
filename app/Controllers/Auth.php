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
        return view('login');
    }

    // PROBLEM IS THAT I CAN'T LOGIN AS ADMIN ANYMORE
    public function loginUser()
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

    public function register()
    {
        return view('register');
    }

    public function registerUser()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $userModel = new UserModel();

        $userModel->save([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        return redirect()->to('/login')->with('msg','Account created. You can now login.');
    }

public function verify($token)
{
    $userModel = new \App\Models\UserModel();

    $user = $userModel->where('verification_token',$token)->first();

    if($user){

        $userModel->update($user['id'],[
            'is_verified' => 1,
            'verification_token' => null
        ]);

        return redirect()->to('/login')->with('msg','Email verified. You can now login.');
    }

    return redirect()->to('/login')->with('msg','Invalid verification link.');
}
}