<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser()
    {
        $login = trim((string) ($this->request->getPost('login') ?? $this->request->getPost('email')));
        $password = $this->request->getPost('password');

        // ADMIN LOGIN
        if (in_array($login, ['admin', 'admini'], true) && $password === 'admin')
        {
            session()->set('isAdmin', true);
            return redirect()->to(base_url('admin/campaigns'));
        }

        $userModel = new \App\Models\UserModel();

        $user = $userModel
            ->groupStart()
                ->where('email', $login)
                ->orWhere('name', $login)
            ->groupEnd()
            ->first();

        if ($user && password_verify($password, $user['password']))
        {
            if (isset($user['is_active']) && (int) $user['is_active'] === 0) {
                return redirect()->back()->with('error','This account is disabled. Contact support for assistance.');
            }

            if(isset($user['is_verified']) && $user['is_verified'] == 0){
                return redirect()->back()->with('error','Please verify your email first.');
            }

            session()->set('user_id', $user['id']);
            session()->set('name', $user['name']);

            return redirect()->to('/');
        }

        return redirect()->back()->with('error','Invalid login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function register()
    {
        return view('register');
    }

public function registerUser()
{
    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

    $token = bin2hex(random_bytes(32));

    $userModel = new \App\Models\UserModel();

    $userData = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'role' => 'user',
        'verification_token' => $token,
        'is_verified' => 0
    ];

    $db = \Config\Database::connect();
    $userFields = $db->getFieldNames('users');
    if (in_array('is_active', $userFields, true)) {
        $userData['is_active'] = 1;
    }

    $userModel->save($userData);

    // SEND EMAIL
    $emailService = \Config\Services::email();

    $emailService->setTo($email);
    $emailService->setFrom('norwood0602@gmail.com','Sinag Donation');

    $emailService->setSubject('Verify your account');

    $link = base_url('/verify/'.$token);

    $message = "
    <h2>Welcome to SINAG Donation</h2>
    <p>Please verify your email by clicking the link below:</p>
    <a href='$link'>Verify Account</a>
    ";

    $emailService->setMessage($message);
    $emailService->send();

    return redirect()->to('/login')->with('msg','Account created! Check your email to verify.');
}

    public function verify($token)
    {
        $userModel = new UserModel();

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