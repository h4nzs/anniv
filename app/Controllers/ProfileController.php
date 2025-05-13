<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PostModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $postModel = new PostModel();
        $userId = session()->get('user_id');
        $user = $userModel
    ->select('id, username, name, gender, birthdate, visible_birthdate, profile_pic, description')
    ->where('id', session()->get('user_id'))
    ->first();


        $posts = $postModel
            ->where('user_id', $userId)
            ->where('is_anonymous', 0)
            ->where('visible_on_profile', 1)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('profile/index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function edit()
    {
        $userModel = new UserModel();
        $user = $userModel->find(session()->get('user_id'));
        return view('profile/edit', ['user' => $user]);
    }

    public function update()
{
    $userModel = new UserModel();
    $session = session();
    $id = $session->get('user_id');

    // Ambil data lama user
    $oldUser = $userModel->find($id);

    // Ambil data dari form
    $data = [
        'name' => $this->request->getPost('name'),
        'username' => $this->request->getPost('username'),
        'gender' => $this->request->getPost('gender'),
        'birthdate' => $this->request->getPost('birthdate'),
        'description' => $this->request->getPost('description'),
        'visible_birthdate' => $this->request->getPost('visible_birthdate') ? 1 : 0,
    ];

    // Cek dan proses upload foto profil
    $file = $this->request->getFile('profile_pic');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $fileName = $file->getRandomName();
        $file->move('uploads/profile_pics/', $fileName);
        $data['profile_pic'] = $fileName;

        // Hapus foto lama jika ada
        if (!empty($oldUser['profile_pic']) && file_exists('uploads/profile_pics/' . $oldUser['profile_pic'])) {
            unlink('uploads/profile_pics/' . $oldUser['profile_pic']);
        }

        // ✅ Update juga ke session
        $session->set('profile_pic', $fileName);
        $session->set('name', $data['name']);
        $session->set('username', $data['username']);
        
    }

    $userModel->update($id, $data);

    return redirect()->to('/profile')->with('success', 'Profil diperbarui');
}
}
