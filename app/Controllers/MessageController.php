<?php

namespace App\Controllers;
use App\Models\ConversationModel;
use App\Models\MessageModel;
use App\Models\UserModel;

class MessageController extends BaseController
{
    public function index($conversation_id = null)
{
    $session = session();
    $userId = $session->get('id');

    $messageModel = new MessageModel();
    $userModel = new UserModel();

    // Ambil semua conversation yang melibatkan user
    $conversations = $messageModel->getConversationList($userId);
    $contacts = [];

    // Tentukan kontak (lawan bicara) dari tiap conversation
    foreach ($conversations as $conv) {
        if ($conv['user1_id'] == $userId) {
            $contacts[] = [
                'id' => $conv['user2_id'],
                'name' => $conv['user2_name'],
                'profile_pic' => $conv['user2_pic'],
                'conversation_id' => $conv['id']
            ];
        } else {
            $contacts[] = [
                'id' => $conv['user1_id'],
                'name' => $conv['user1_name'],
                'profile_pic' => $conv['user1_pic'],
                'conversation_id' => $conv['id']
            ];
        }
    }

    // Ambil isi pesan jika ada conversation_id yang diklik
    $messages = [];
    if ($conversation_id) {
        $messages = $messageModel->getMessagesByConversation($conversation_id);
    }

    return view('messages/index', [
        'conversations' => $conversations,
        'contacts' => $contacts, // ✅ Sekarang sudah terdefinisi
        'messages' => $messages,
        'userId' => $userId,
        'activeConversation' => $conversation_id,
    ]);
}

public function getMessagesByUser($userId)
{
    $session = session();
    $senderId = $session->get('id');
    
    if (!$senderId) {
        return redirect()->to('/login');
    }
    
    if (!$currentUserId) {
        return $this->response->setStatusCode(401)->setJSON(['error' => 'User not logged in']);
    }

    $convModel = new \App\Models\ConversationModel();
    $messageModel = new \App\Models\MessageModel();

    $conversationId = $convModel->getOrCreateConversation($currentUserId, $userId);
    $messages = $messageModel->getMessagesByConversation($conversationId);

    return $this->response->setJSON($messages);
}

    public function send()
{
    $session = session();
    $senderId = $session->get('id');

    // Pastikan user sudah login
    if (!$senderId) {
        return redirect()->to('/login');
    }
    $receiverId = $this->request->getPost('receiver_id');
    $messageText = $this->request->getPost('message');

    if (!$receiverId) {
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Receiver not specified']);
    }

    // Cari atau buat conversation_id
    $convModel = new \App\Models\ConversationModel();
    $conversationId = $convModel->getOrCreateConversation($senderId, $receiverId);

    $messageModel = new \App\Models\MessageModel();

    // Simpan pesan teks
    if (!empty($messageText)) {
        $messageModel->insert([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'message' => $messageText,
        ]);
    }

    // Upload file jika ada
    $media = $this->request->getFile('media');
    if ($media && $media->isValid()) {
        $filename = $media->getRandomName();
        $media->move(FCPATH . 'uploads/media', $filename);

        $messageModel->insert([
            'conversation_id' => $conversationId,
            'sender_id' => $senderId,
            'message' => '[media]' . $filename,
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}

public function searchUser()
{
    $query = $this->request->getGet('query');
    $userId = session('id');

    $userModel = new \App\Models\UserModel();

    $results = $userModel
        ->where('id !=', $userId)
        ->groupStart()
            ->like('username', $query)
            ->orLike('name', $query)
        ->groupEnd()
        ->select('id, name, profile_pic')
        ->findAll();

    return $this->response->setJSON($results);
}

public function getContacts()
{
    $userId = session('id');
    $messageModel = new \App\Models\MessageModel();
    $userModel = new \App\Models\UserModel();

    // Ambil distinct user yang sudah pernah berkirim pesan
    $contactIds = $messageModel
        ->select('IF(sender_id = '.$userId.', receiver_id, sender_id) as contact_id', false)
        ->where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->groupBy('contact_id')
        ->findAll();

    $ids = array_column($contactIds, 'contact_id');

    $contacts = [];
    if (!empty($ids)) {
        $contacts = $userModel
            ->whereIn('id', $ids)
            ->select('id, name, profile_pic')
            ->findAll();
    }

    return $this->response->setJSON($contacts);
}

public function sendVoice()
{
    $senderId = session('id');
    $receiverId = $this->request->getPost('receiver_id');
    $voice = $this->request->getFile('voice');

    if (!$receiverId || !$voice || !$voice->isValid()) {
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid input']);
    }

    // Cari atau buat conversation_id
    $convModel = new \App\Models\ConversationModel();
    $conversationId = $convModel->getOrCreateConversation($senderId, $receiverId);

    // Simpan file suara
    $filename = uniqid('voice_') . '.webm';
    $voice->move(FCPATH . 'uploads/voice', $filename);

    $messageModel = new \App\Models\MessageModel();
    $messageModel->insert([
        'conversation_id' => $conversationId,
        'sender_id' => $senderId,
        'message' => '[voice]' . $filename,
    ]);

    return $this->response->setJSON(['status' => 'success']);
}

    public function getConversations()
    {
        $userId = session('id');
        $messageModel = new MessageModel();
        $conversations = $messageModel->getConversationList($userId);
        return $this->response->setJSON($conversations);
    }

    public function getMessages($conversation_id)
    {
        $messageModel = new MessageModel();
        $messages = $messageModel->getMessagesByConversation($conversation_id);
        return $this->response->setJSON($messages);
    }

    public function checkSession()
{
    $session = session();
    $userId = $session->get('id');

    if ($userId) {
        return $this->response->setJSON(['logged_in' => true]);
    }

    return $this->response->setJSON(['logged_in' => false]);
}

}
