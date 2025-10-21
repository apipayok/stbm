<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageUser extends BaseController
{
    public function viewUsers()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('admin/admin_user', ['users' => $users]);
    }

    public function toggleAdmin($staffno)
    {
        $userModel = new UserModel();
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
        $userModel = new UserModel();
        $user = $userModel->where('staffno', $staffno)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $userModel->where('staffno', $staffno)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}