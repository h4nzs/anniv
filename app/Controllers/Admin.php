<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->userModel = new UserModel(); // Inisialisasi model
    }

    public function index()
    {
        $userModel = new \App\Models\UserModel();
        $search = $this->request->getGet('search');
        $query = new \App\Models\UserModel();

        if ($search) {
            $query = $query->like('username', $search)
                           ->orLike('email', $search)
                           ->orLike('username', $search);
        }

        $users = $query->findAll();
        $adminCount = (new \App\Models\UserModel())->where('role', 'admin')->countAllResults();
        $regularCount = (new \App\Models\UserModel())->where('role', 'user')->countAllResults();
        

        return view('admin/dashboard_admin', [
            'users' => $users,
            'adminCount' => $adminCount,
            'regularCount' => $regularCount,
            'search' => $search,
        ]);
    }

    public function resetPassword($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin')->with('error', 'User tidak ditemukan.');
        }

        $this->userModel->update($id, [
            'password' => password_hash('12345678', PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/admin')->with('success', 'Password berhasil direset ke "12345678".');
    }
    public function deleteUser($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin')->with('error', 'User tidak ditemukan.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin')->with('success', 'User berhasil dihapus.');
    }
    
    public function edit($id)
{
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($id);

    if (!$user) {
        return redirect()->to('/admin')->with('error', 'User tidak ditemukan.');
    }

    return view('admin/edit_user', ['user' => $user]);
}

public function userList()
{
    $userModel = new \App\Models\UserModel();
    $users = $userModel->findAll(); // Ambil semua user

    return view('admin/user_list', [
        'users' => $users // Kirim ke view sebagai 'users'
    ]);
}

public function update($id)
{
    $userModel = new \App\Models\UserModel();

    $data = [
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'name' => $this->request->getPost('name'),
        'role' => $this->request->getPost('role')
    ];

    $userModel->update($id, $data);
    return redirect()->to('/admin')->with('message', 'User berhasil diperbarui.');
}

public function create()
{
    return view('admin/create_user');
}

public function store()
{
    $validation = \Config\Services::validation();

    $data = $this->request->getPost();

    $rules = [
        'username' => 'required|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'name'     => 'required',
        'role'     => 'required|in_list[admin,user]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $this->userModel->save([
        'username' => $data['username'],
        'email'    => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'name'     => $data['name'],
        'role'     => $data['role']
    ]);

    return redirect()->to('/admin')->with('success', 'User baru berhasil ditambahkan.');
}
public function posts()
{
    $model = new \App\Models\PostModel();
    $data['posts'] = $model->select('posts.*, users.username')
        ->join('users', 'users.id = posts.user_id')
        ->findAll();

    return view('admin/posts', $data);
}

}
