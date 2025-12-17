<?php

namespace App\Controllers;

use App\Libraries\Model;
use App\Libraries\DepartmentJoin;
use App\Controllers\BaseController;

class Profile extends BaseController
{
    // Show profile details
    public function view()
    {
        $username = session()->get('username');
        $staffno = session()->get('staffno');

        $deptJoin = new DepartmentJoin();
        $department = $deptJoin->getDepartmentByStaffNo($staffno);

        $data = [
            'username' => $username,
            'staffno' => $staffno,
            'department_name' => $department['department_name'] ?? null,
            'parent_department_name' => $department['parent_department_name'] ?? null,
        ];

        return view('pages/profile', $data);
    }

    public function editForm()
    {
        $staffno = session()->get('staffno');

        $deptJoin = new DepartmentJoin();
        $department = $deptJoin->getDepartmentByStaffNo($staffno);

        $deptModel = Model::department();
        $departments = $deptModel->findAll(); // For dropdown

        $data = [
            'username' => session()->get('username'),
            'staffno' => $staffno,
            'department_id' => $department['department_id'] ?? null,
            'departments' => $departments
        ];

        return view('profile/edit_profile', $data);
    }

    public function edit()
    {
        $userModel = Model::user();
        $staffno = session()->get('staffno');

        $username = post('username');
        $password = post('password');
        $departmentId = post('department');

        $user = $userModel->where('staffno', $staffno)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $data = [
            'username'   => $username,
            'department' => $departmentId
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($user['id'], $data);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    }

}
