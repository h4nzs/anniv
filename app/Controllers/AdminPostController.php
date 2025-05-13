<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CommentModel;
use App\Models\UserModel;

class AdminPostController extends BaseController
{
    public function index()
    {
        $postModel = new \App\Models\PostModel();
        $commentModel = new \App\Models\CommentModel();

        $posts = $postModel
            ->select('posts.*, users.username, users.role')
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

        return view('admin/posts', ['posts' => $posts]);
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
            return redirect()->to('/admin/posts');
        } else {
            echo "❌ Gagal simpan ke database.";
            return;
        }
    }

    return view('/admin/create');
}

public function edit($id)
{
    $postModel = new PostModel();
    $post = $postModel->find($id);

    if (!$post) {
        return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
    }
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

        // Update post
        $postModel->update($id, [
            'content'      => $content,
            'is_anonymous' => $isAnonymous,
            'media_url'    => $mediaPath,
        ]);

        return redirect()->to('admin/posts')->with('success', 'Postingan berhasil diperbarui.');
    }

    return view('admin/edit', ['post' => $post]);
}

public function update($id)
{
    $postModel = new PostModel();
    $post = $postModel->find($id);

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

    return redirect()->to('admin/posts/')->with('success', 'Postingan berhasil diperbarui.');
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

    return redirect()->to('/admin/posts')->with('success', 'Postingan berhasil dikirim!');
}
    public function delete($postId)
    {
        $postModel = new PostModel();

        $post = $postModel->find($postId);

        if (!$post) {
            return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
        }

        // Optional: Hapus media jika ada
        if (!empty($post['media_url'])) {
            $mediaPath = WRITEPATH . '../public/uploads/media/' . $post['media_url'];
            if (file_exists($mediaPath)) {
                unlink($mediaPath);
            }
        }

        $postModel->delete($postId);

        return redirect()->back()->with('success', 'Postingan berhasil dihapus.');
    }

    public function addComment($postId)
    {
        $commentModel = new CommentModel();
        $postModel = new PostModel();

        $post = $postModel->find($postId);

        if (!$post) {
            return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
        }

        $comment = $this->request->getPost('comment');

        if (empty($comment)) {
            return redirect()->back()->with('error', 'Komentar tidak boleh kosong.');
        }

        $commentModel->save([
            'post_id' => $postId,
            'user_id' => session()->get('user_id'), // pastikan admin login
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
