<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->has('user')) {
            return $this->redirectByRole(session('user')['role']);
        }
        return view('auth/login');
    }

    public function loginPost()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        // JOIN roles to get role.name alongside user data
        $found = $userModel->db->table('users u')
            ->select('u.*, r.name AS role_name')
            ->join('roles r', 'r.id = u.role', 'left')
            ->where('u.username', $email)
            ->get()->getRowArray();

        if (! $found || ! password_verify($password, $found['password'])) {
            return redirect()->back()->withInput()
                             ->with('error', 'Invalid email or password.');
        }

        session()->set([
            'user' => [
                'id'    => $found['id'],
                'name'  => $found['fullname'],
                'email' => $found['username'],
                'role'  => $found['role_name'],  // 'student', 'teacher', 'admin'
            ],
        ]);

        return $this->redirectByRole($found['role_name']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }

    public function register()
    {
        $roleModel = new RoleModel();
        return view('auth/register', ['roles' => $roleModel->getDropdown()]);
    }

    public function registerPost()
    {
        $rules = [
            'fullname' => 'required|min_length[2]|max_length[100]',
            'username' => 'required|valid_email|is_unique[users.username]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()
                             ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->insert([
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => (int) $this->request->getPost('role'),
        ]);

        session()->setFlashdata('success', 'Account created successfully.');
        return redirect()->to('/admin/users');
    }

    private function redirectByRole(?string $role)
    {
        return match($role) {
            'admin'   => redirect()->to('/dashboard'),
            'teacher' => redirect()->to('/dashboard'),
            'student' => redirect()->to('/student/dashboard'),
            default   => redirect()->to('/login'),
        };
    }
}
