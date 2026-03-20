<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        $data = [
            'user'        => session('user'),
            'totalUsers'  => $userModel->countAllResults(),
            'totalRoles'  => $roleModel->countAllResults(),
            'students'    => $userModel->db->table('users u')
                ->join('roles r', 'r.id = u.role', 'left')
                ->where('r.name', 'student')
                ->countAllResults(),
        ];

        return view('dashboard', $data);
    }
}
