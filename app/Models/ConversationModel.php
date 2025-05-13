<?php

namespace App\Models;

use CodeIgniter\Model;

class ConversationModel extends Model
{
    protected $table = 'conversations';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user1_id', 'user2_id', 'created_at'];
    protected $useTimestamps = true;

    /**
     * Cari conversation_id antara dua user, atau buat jika belum ada
     */
    public function getOrCreateConversation($user1, $user2)
    {
        // Pastikan user1 selalu lebih kecil dari user2 (untuk konsistensi)
        if ($user1 > $user2) {
            [$user1, $user2] = [$user2, $user1];
        }

        // Cek apakah sudah ada
        $conversation = $this->where('user1_id', $user1)
                             ->where('user2_id', $user2)
                             ->first();

        if ($conversation) {
            return $conversation['id'];
        }

        // Jika belum, buat
        return $this->insert([
            'user1_id' => $user1,
            'user2_id' => $user2
        ], true); // 'true' agar mengembalikan ID
    }

    /**
     * Ambil semua conversation yang melibatkan user ini
     */
    public function getUserConversations($userId)
    {
        return $this->where('user1_id', $userId)
                    ->orWhere('user2_id', $userId)
                    ->findAll();
    }
}
