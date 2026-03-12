<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function show()
    {
        $username = session('username');
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $data = array_merge($this->data, ['user' => $user]);
        return view('profile/show', $data);
    }

    public function edit()
    {
        $username = session('username');
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        $data = array_merge($this->data, ['user' => $user]);
        return view('profile/edit', $data);
    }

    public function update()
    {
        $username = session('username');
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();
        $userId = $user['id'];

        $rules = [
            'fullname' => 'required|min_length[3]',
            'username' => "required|valid_email|is_unique[users.username,id,{$userId}]",
            'student_id' => 'permit_empty|max_length[20]',
            'course' => 'permit_empty|max_length[100]',
            'year_level' => 'permit_empty|integer|greater_than[0]|less_than[6]',
            'section' => 'permit_empty|max_length[50]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($file->isValid() && in_array($file->getMimeType(), ['image/jpg', 'image/jpeg', 'image/png', 'image/webp']) && $file->getSize() <= 2048000) {
                if (!empty($user['profile_image'])) {
                    $oldPath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $ext = $file->getExtension();
                $filename = 'avatar_' . $userId . '_' . time() . '.' . $ext;
                $file->move(FCPATH . 'uploads/profiles/', $filename);
                $updateData['profile_image'] = $filename;
            }
        }

        $userModel->updateProfile($userId, $updateData);

        session()->set('username', $updateData['username']);

        return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
    }
}
