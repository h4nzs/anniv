<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'gender',
        'birthdate',
        'visible_birthdate',
        'profile_pic',
        'description',
    ];

    protected $useTimestamps = true; // Kalau mau otomatis isi created_at, updated_at

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;
}
