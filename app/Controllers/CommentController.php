<?php

namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\Controller;

class CommentController extends BaseController
{
    public function store()
    {
        $commentModel = new CommentModel();

        $data = [
            'post_id' => $this->request->getPost('post_id'),
            'user_id' => session()->get('user_id'),
            'comment' => $this->request->getPost('comment'),
        ];

        $commentModel->insert($data);
        return redirect()->to('/posts');
    }
}
