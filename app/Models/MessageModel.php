<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'conversation_id',
        'sender_id',
        'message',
        'file_type', // jenis file: text, image, video, document, audio
        'file_path',
        'created_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;

    /**
     * Ambil semua pesan berdasarkan conversation_id
     */
    public function getMessagesByConversation($conversation_id)
    {
        return $this->where('conversation_id', $conversation_id)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    public function getConversationList($user_id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('conversations');
    $builder->select('conversations.*, u1.name as user1_name, u1.profile_pic as user1_pic, u2.name as user2_name, u2.profile_pic as user2_pic');
    $builder->join('users u1', 'u1.id = conversations.user1_id');
    $builder->join('users u2', 'u2.id = conversations.user2_id');
    $builder->groupStart()
            ->where('user1_id', $user_id)
            ->orWhere('user2_id', $user_id)
            ->groupEnd();
    return $builder->get()->getResultArray();
}

    /**
     * Ambil pesan terakhir dari semua conversation user (untuk tampilan sidebar)
     */
    public function getLastMessagesByUser($user_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('messages m');
        $builder->select('m.*, u.username, u.name, u.profile_pic, c.user1_id, c.user2_id');
        $builder->join('conversations c', 'c.id = m.conversation_id');
        $builder->join('users u', 'u.id = m.sender_id');
        $builder->where('c.user1_id', $user_id)
                ->orWhere('c.user2_id', $user_id);
        $builder->orderBy('m.created_at', 'DESC');
        $builder->groupBy('m.conversation_id');
        return $builder->get()->getResultArray();
    }

    /**
     * Tambahkan pesan baru
     */
    public function addMessage($data)
    {
        return $this->insert($data);
    }
}
