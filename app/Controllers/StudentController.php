<?php

namespace App\Controllers;

use App\Models\UserModel;

class StudentController extends BaseController
{
    public function dashboard()
    {
        $userModel = new UserModel();
        $user = $userModel->findWithRole(session('user')['id']);

        return view('student/dashboard', ['user' => $user]);
    }
}
