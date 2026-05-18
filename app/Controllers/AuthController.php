<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth\login');
    }

    public function loginPost()
    {
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->with('error','Invalid login');
        }

        session()->set('user', $user);
        session()->set('user_id', $user['id']);
        // print_r($user);exit;
        return redirect()->to('admin/exams');
    }

    public function register()
    {
        return view('auth\register');
    }

    public function registerPost()
    {
        $userModel = new UserModel();

        $userModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')->with('success','Registered successfully');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
