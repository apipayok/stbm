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

        $rules = [
            'staffno'    => 'required',
            'username'   => 'required|min_length[3]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'department' => 'required',
            'password'   => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $staffno    = Post('staffno');
        $username   = Post('username');
        $email      = Post('email');
        $password   = Post('password');
        $department = Post('department');

        if ($UserModel->where('staffno', $staffno)->first()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Staff number already exists');
        }

        $data = [
            'staffno'    => $staffno,
            'username'   => $username,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'department' => $department,
        ];

        //dd($data);

        $UserModel->insert($data);

        return redirect()->to('/login')->with('message', 'Registration Successful!');

    }


    public function login()
    {
        $UserModel = Model::user();
        $user = $UserModel->where('staffno', Post('staffno'))->first();

        if ($user && password_verify(Post('password'), $user['password'])) {
            session()->set([
                'staffno' => $user['staffno'],
                'username' => $user['username'],
                'is_admin' => $user['is_admin'],
                'department' => $user['department'],
                'email' => $user['email'],
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
