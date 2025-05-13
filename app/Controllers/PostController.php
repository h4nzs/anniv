<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class PostController extends BaseController
{
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        helper(['form', 'url']);
    }

    public function index()
{
    $postModel = new \App\Models\PostModel();
    $commentModel = new \App\Models\CommentModel();
    $posts = $postModel
        ->select('posts.*, users.username, users.role, profile_pic')
        ->join('users', 'users.id = posts.user_id', 'left')
        ->orderBy('posts.created_at', 'DESC')
        ->findAll();

        foreach ($posts as &$post) {
            $post['comments'] = $commentModel
                ->select('comments.*, users.username, users.role')
                ->join('users', 'users.id = comments.user_id')
                ->where('post_id', $post['id'])
                ->orderBy('comments.created_at', 'ASC')
                ->findAll();
        }

    return view('posts/index', ['posts' => $posts]);
}

    public function create()
{
    helper(['form']);
    $postModel = new \App\Models\PostModel();
    $userId = session()->get('user_id');

    if ($this->request->getMethod() === 'post') {
        $content = $this->request->getPost('content');
        $isAnonymous = $this->request->getPost('is_anonymous') ? 1 : 0;

        // handle file
        $media = $this->request->getFile('media');
        $mediaPath = null;

        if ($media && $media->isValid() && !$media->hasMoved()) {
            $newName = $media->getRandomName();
            $media->move('uploads', $newName);
            $mediaPath = 'uploads/' . $newName;
        }

        $saved = $postModel->save([
            'user_id'      => $userId,
            'content'      => $content,
            'is_anonymous' => $isAnonymous,
            'media_url'    => $mediaPath,
        ]);

        if ($saved) {
            return redirect()->to('/posts');
        } else {
            echo "❌ Gagal simpan ke database.";
            return;
        }
    }

    return view('posts/create');
}

public function addComment($postId)
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    $commentModel = new \App\Models\CommentModel();

    $commentModel->save([
        'post_id' => $postId,
        'user_id' => session()->get('user_id'),
        'comment' => $this->request->getPost('comment'),
    ]);

    return redirect()->to('/posts')->with('success', 'Komentar berhasil ditambahkan.');
}

public function edit($id)
{
    $postModel = new PostModel();
    $post = $postModel->find($id);

    if (!$post || $post['user_id'] != session()->get('user_id')) {
        return redirect()->to('/posts')->with('error', 'Akses ditolak.');
    }

    return view('posts/edit', ['post' => $post]);
}

public function delete($id)
{
    $postModel = new PostModel();
    $post = $postModel->find($id);

    // Hanya pemilik yang bisa hapus
    if (!$post || $post['user_id'] != session()->get('user_id')) {
        return redirect()->to('/posts')->with('error', 'Akses ditolak.');
    }

    // Hapus file media kalau ada
    if (!empty($post['media_url']) && file_exists(ROOTPATH . 'public/uploads/media/' . $post['media_url'])) {
        unlink(ROOTPATH . 'public/uploads/media/' . $post['media_url']);
    }

    $postModel->delete($id);

    return redirect()->to('/posts')->with('success', 'Postingan dihapus.');
}

public function update($id)
{
    $postModel = new PostModel();
    $post = $postModel->find($id);

    if (!$post || $post['user_id'] != session()->get('user_id')) {
        return redirect()->to('/posts')->with('error', 'Akses ditolak.');
    }

    $data = [
        'content' => $this->request->getPost('content'),
        'is_anonymous' => $this->request->getPost('is_anonymous') ? 1 : 0,
    ];

    // Jika user upload media baru
    $media = $this->request->getFile('media');
    if ($media && $media->isValid() && !$media->hasMoved()) {
        $newName = $media->getRandomName();
        $media->move(ROOTPATH . 'public/uploads/media', $newName);
        $data['media_url'] = $newName;

        // Optional: hapus media lama
        if (!empty($post['media_url']) && file_exists(ROOTPATH . 'public/uploads/media/' . $post['media_url'])) {
            unlink(ROOTPATH . 'public/uploads/media/' . $post['media_url']);
        }
    }

    $postModel->update($id, $data);

    return redirect()->to('/posts')->with('success', 'Postingan berhasil diperbarui.');
}


public function store()
{
    $session = session();
    $postModel = new \App\Models\PostModel();

    $isAnonymous = $this->request->getPost('is_anonymous') ? 1 : 0;
    $userId = $session->get('user_id');
    $content = $this->request->getPost('content');

    $file = $this->request->getFile('media');
    $mediaName = null;

    // Cek apakah ada file yang diupload
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $mediaName = $file->getRandomName(); // nama acak agar unik
        $file->move('uploads/media', $mediaName); // simpan ke folder
    }

    $data = [
        'user_id'     => $userId,
        'content'     => $content,
        'is_anonymous'=> $isAnonymous,
        'media_url'   => $mediaName,
    ];

    $postModel->insert($data);

    return redirect()->to('/posts')->with('success', 'Postingan berhasil dikirim!');
}


}
