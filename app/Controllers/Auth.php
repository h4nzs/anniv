<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function saveRegister()
    {
        $userModel = new UserModel();
        $userModel->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'  => user
        ]);
        return redirect()->to('/login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function authLogin()
    {
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();
        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'name' => $user['name'],
                'profile_pic' => $user['profile_pic'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            return redirect()->to('/');
        }
        return redirect()->back()->with('error', 'Login gagal');
    }

    public function attemptLogin()
{
    $rules = [
        'email' => 'required|valid_email',
        'password' => 'required'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('email', $this->request->getPost('email'))->first();

    if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    // Set session
    $session = session();
    $session->set([
        'user_id' => $user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'name' => $user['name'],
        'profile_pic' => $user['profile_pic'],
        'role' => $user['role'],
        'logged_in' => true,
    ]);

    // Redirect berdasarkan role
    if ($user['role'] === 'admin') {
        return redirect()->to('/admin');
    } else {
        return redirect()->to('/');
    }


    return redirect()->back()->with('error', 'Email atau password salah.');
}


public function attemptRegister()
{
    $rules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'username' => 'required|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'confirm_password' => 'required|matches[password]',
        'birthdate' => 'permit_empty|valid_date[Y-m-d]',
        'gender' => 'permit_empty|in_list[Laki-laki,Perempuan]',
    ];

    log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

    if (!$this->validate($rules)) {
        log_message('error', 'Validation failed: ' . json_encode($this->validator->getErrors()));
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $userModel = new \App\Models\UserModel();
    $roleModel = new \App\Models\RoleModel();

    $defaultRole = $roleModel->where('name', 'user')->first();

    $visibleBirthdate = $this->request->getPost('visible_birthdate') ? 1 : 0;

    $userModel->save([
        'name' => $this->request->getPost('name'),
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role' => $defaultRole ?? 'user',
        'gender' => $this->request->getPost('gender'),
        'birthdate' => $this->request->getPost('birthdate'),
        'visible_birthdate' => $visibleBirthdate,
    ]);

    return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
