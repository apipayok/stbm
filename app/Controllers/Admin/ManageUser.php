<?php

namespace App\Controllers\Admin;

use App\Libraries\DepartmentJoin;
use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageUser extends BaseController
{
    public function viewUsers()
    {
        $userModel = Model::user();
        $deptJoin  = new DepartmentJoin();

        $perPage = 5;

        $admins = $userModel->where('is_admin', 1)->paginate($perPage, 'admins');
        $pagerAdmin = $userModel->pager;

        $users = $userModel->where('is_admin', 0)->paginate($perPage, 'users');
        $pagerUser = $userModel->pager;

        foreach ($admins as &$admin) {
            $dept = $deptJoin->getDepartmentByStaffNo($admin['staffno']);
            $admin['department_name'] = $dept['department_name'] ?? null;
            $admin['parent_department_name'] = $dept['parent_department_name'] ?? null;
        }

        foreach ($users as &$user) {
            $dept = $deptJoin->getDepartmentByStaffNo($user['staffno']);
            $user['department_name'] = $dept['department_name'] ?? null;
            $user['parent_department_name'] = $dept['parent_department_name'] ?? null;
        }

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

    public function adminView($staffno)
    {
        $userModel = Model::user();
        $user = $userModel->where('staffno', $staffno)->first();

        $deptJoin = new DepartmentJoin();
        $department = $deptJoin->getDepartmentByStaffNo($staffno);

        $deptModel = Model::department();
        $departments = $deptModel->findAll() ?? [];

        $data = [
            'username' => $user['username'] ?? '',
            'staffno' => $staffno,
            'department_id' => $department['department_id'] ?? null,
            'departments' => $departments
        ];

        return view('profile/profile_popup', $data);
    }
}
