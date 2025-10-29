<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function viewRegister()
    {
        return view ('auth/register');
    }

    //register function
    public function register()
    {
        $UserModel = new UserModel();
        $data = [
                'staffno' => $this->request->getPost('staffno'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ];

        $UserModel->save($data);
        return redirect()->to('/login')->with('message', 'Registration Successful!');   
    }

    public function viewLogin()
    {
        return view ('auth/login');
    }

    //login function
    public function login()
    {
        $UserModel = new UserModel();
        $user = $UserModel->where('staffno', $this->request->getPost('staffno'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])){
            session()->set([
                'staffno' => $user['staffno'],
                'username' => $user['username'],
                'is_admin' => $user['is_admin'],
                'logged_in' => true,
                ]);

                if ($user['is_admin'] == 1){
                    return redirect()->to('admin/dashboard');//japgi ubah - buat admin dashboard lak
                }else{
                return redirect()->to('/dashboard');
                }
                }
                else
                {
                    return redirect()->back()->with('error', 'Invalid credentials');
                }            
    }

    //logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
