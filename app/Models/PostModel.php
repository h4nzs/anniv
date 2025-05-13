<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table      = 'posts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id', 'content', 'media_url', 'is_anonymous', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
