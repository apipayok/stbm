<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function viewRegister()
    {
        return view('auth/register');
    }

    public function viewLogin()
    {
        return view('auth/login');
    }

    public function register()
    {
        $UserModel = Model::user();

        $staffno = Post('staffno');
        $username = Post('username');
        $password = Post('password');

        $existingStaff = $UserModel->where('staffno', $staffno)->first();
        if ($existingStaff) {
            return redirect()->back()->with('error', 'Staff number already exists');
        }

        $data = [
            'staffno' => $staffno,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $UserModel->save($data);
        return redirect()->to('/login')->with('message', 'Registration Successful!');
    }

    public function login()
    {
        $UserModel = Model::user();
        $user = $UserModel->where('staffno', $this->request->getPost('staffno'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
                'staffno' => $user['staffno'],
                'username' => $user['username'],
                'is_admin' => $user['is_admin'],
                'logged_in' => true,
            ]);

            if ($user['is_admin'] == 1) {
                return redirect()->to('admin/dashboard'); //japgi ubah - buat admin dashboard lak
            } else {
                return redirect()->to('/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
