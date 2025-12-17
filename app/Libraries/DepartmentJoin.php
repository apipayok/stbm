<?php

namespace App\Libraries;

use Config\Database;

class DepartmentJoin
{
    public function joinDepartment()
    {
        $db = Database::connect();

        $builder = $db->table('users')
            ->select('
                users.*,
                d.Ddesc AS department_name,
                p.Ddesc AS parent_department_name
            ')
            ->join('departments d', 'users.department = d.DID', 'left')
            ->join('departments p', 'd.Dparent = p.DID', 'left');

        return $builder->get()->getResultArray();
    }

    public function getDepartmentByStaffNo($staffno)
{
    $db = Database::connect();

    return $db->table('users')
        ->select('
            d.Ddesc AS department_name,
            p.Ddesc AS parent_department_name
        ')
        ->join('departments d', 'users.department = d.DID', 'left')
        ->join('departments p', 'd.Dparent = p.DID', 'left')
        ->where('users.staffno', $staffno)
        ->get()
        ->getRowArray();
}

}
