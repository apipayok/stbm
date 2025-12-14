<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageUser extends BaseController
{
    public function viewUsers()
    {
        $userModel = Model::user();

        $perPage = 5;

        $admins = $userModel->where('is_admin', 1)->paginate($perPage, 'admins');
        $pagerAdmin = $userModel->pager;
        
        $users = $userModel->where('is_admin', 0)->paginate($perPage, 'users');
        $pagerUser = $userModel->pager;

        $data = [
            'admins' => $admins,
            'pagerAdmin' => $pagerAdmin,
            'users' => $users,
            'pagerUser' => $pagerUser
        ];

        return view('admin/admin_user', ['data' => $data]);
    }

    public function toggleAdmin($staffno)
    {
        $userModel = Model::user();
        $user = $userModel->where('staffno', $staffno)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $newStatus = $user['is_admin'] ? 0 : 1;

        $userModel->update($user['id'], [
            'is_admin' => $newStatus
        ]);

        $msg = $newStatus ? 'User promoted to admin.' : 'Admin rights revoked.';
        return redirect()->back()->with('success', $msg);
    }

    public function deleteUser($staffno)
    {
        $userModel = Model::user();
        $user = $userModel->where('staffno', $staffno)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $userModel->where('staffno', $staffno)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}