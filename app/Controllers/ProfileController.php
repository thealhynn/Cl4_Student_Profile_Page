<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    public function show()
    {
        $user = $this->userModel->findWithRole(session('user')['id']);
        return view('profile/show', ['user' => $user]);
    }

    public function edit()
    {
        $user = $this->userModel->findWithRole(session('user')['id']);
        return view('profile/edit', ['user' => $user]);
    }

    public function update()
    {
        $id = session('user')['id'];

        $data = [
            'fullname'    => $this->request->getPost('name'),
            'student_id'  => $this->request->getPost('student_id'),
            'course'      => $this->request->getPost('course'),
            'year_level'  => $this->request->getPost('year_level'),
            'section'     => $this->request->getPost('section'),
            'phone'       => $this->request->getPost('phone'),
            'address'     => $this->request->getPost('address'),
        ];

        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profiles', $newName);
            $data['profile_image'] = $newName;
        }

        $this->userModel->updateProfile($id, $data);

        // Update name in session
        $sessionUser = session('user');
        $sessionUser['name'] = $data['fullname'];
        session()->set('user', $sessionUser);

        session()->setFlashdata('success', 'Profile updated successfully.');
        return redirect()->to('/profile');
    }
}
