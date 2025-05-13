<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pesan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #121212;
        color: #e0e0e0;
    }

    .chat-container {
        display: flex;
        height: 100vh;
    }

    .user-list {
        width: 25%;
        background-color: #1e1e1e;
        overflow-y: auto;
        border-right: 1px solid #333;
    }

    .chat-box {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .user-list .user {
        padding: 15px;
        border-bottom: 1px solid #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background 0.2s;
    }

    .user-list .user:hover {
        background-color: #2a2a2a;
    }

    .user-list .user img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .messages {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        background-color: #181818;
    }

    .message {
        margin: 10px 0;
        max-width: 70%;
        padding: 10px 15px;
        border-radius: 15px;
        position: relative;
    }

    .me {
        background-color: #3b82f6;
        margin-left: auto;
        color: white;
        text-align: right;
    }

    .other {
        background-color: #333;
        margin-right: auto;
    }

    .input-area {
        display: flex;
        padding: 10px;
        background-color: #1e1e1e;
        border-top: 1px solid #333;
        align-items: center;
    }

    .input-area input[type="text"] {
        flex: 1;
        padding: 10px;
        border: none;
        background-color: #2c2c2c;
        color: #fff;
        border-radius: 10px;
        margin-right: 10px;
    }

    .input-area input[type="file"],
    .input-area button,
    .input-area audio {
        background: none;
        border: none;
        color: #fff;
        margin-right: 5px;
        cursor: pointer;
    }

    .input-area button {
        padding: 8px 15px;
        border-radius: 8px;
        background-color: #3b82f6;
    }

    .audio-record {
        margin-left: 10px;
    }

</style>

<div class="chat-container">
<div class="user-list">
    <div class="p-3 d-flex align-items-center">
        <input type="text" class="form-control me-2" id="searchInput" placeholder="Cari pengguna...">
        <button class="btn btn-primary me-1" onclick="triggerSearch()">Cari</button>
        <button class="btn btn-danger" onclick="resetSearch()">×</button>
    </div>
    <div id="contactList">
        <!-- Kontak user akan ditampilkan di sini -->
        <?php foreach ($contacts as $contact): ?>
            <div class="user" onclick="loadConversation(<?= $contact['id'] ?>)">
                <img src="<?= base_url('uploads/' . $contact['profile_pic']) ?>" alt="avatar">
                <div><?= esc($contact['name']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    <div class="chat-box">
        <div class="messages" id="messages"></div>
        <div class="input-area">
            <input type="text" id="message" placeholder="Type your message...">
            <input type="file" id="media" accept="image/*,video/*,.pdf,.doc,.docx">
            <button onclick="sendMessage()">Send</button>
            <button id="recordBtn">🎤</button>
        </div>
    </div>
</div>

<script>
     let currentUser = <?= json_encode(session('id')) ?>;
    let currentTarget = null;

    function loadConversation(userId) {
    currentTarget = userId;
    fetch(`<?= base_url('chat/messages/user') ?>/${userId}`, {
    method: 'GET',
    credentials: 'include' // Pastikan cookie session dikirim
})        .then(res => res.json())
        .then(data => {
            let container = document.getElementById('messages');
            container.innerHTML = '';

            if (Array.isArray(data)) {
                data.forEach(msg => {
                    let div = document.createElement('div');
                    div.className = 'message ' + (msg.sender_id == currentUser ? 'me' : 'other');
                    div.textContent = msg.message;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = '<div class="text-center text-muted">Belum ada pesan.</div>';
            }

            container.scrollTop = container.scrollHeight;
        })
        .catch(err => {
            console.error('Gagal memuat pesan:', err);
        });
}

    function sendMessage() {
        let msg = document.getElementById('message').value;
        let media = document.getElementById('media').files[0];
        let formData = new FormData();
        formData.append('message', msg);
        formData.append('receiver_id', currentTarget);
        if (media) formData.append('media', media);

        fetch('<?= base_url('chat/send') ?>', {
            method: 'POST',
            body: formData
        }).then(() => {
            document.getElementById('message').value = '';
            document.getElementById('media').value = '';
            loadConversation(currentTarget);
        });
    }

    // 🔍 Tambahkan fungsi pencarian di sini
    function triggerSearch() {
        const query = document.getElementById('searchInput').value.trim();
        if (query !== '') {
            fetch(`<?= base_url('chat/searchUser') ?>?query=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(users => {
                    const list = document.getElementById('contactList');
                    list.innerHTML = '';

                    if (users.length === 0) {
                        list.innerHTML = '<div class="p-3 text-muted">Tidak ditemukan</div>';
                        return;
                    }

                    users.forEach(user => {
                        const div = document.createElement('div');
                        div.className = 'user';
                        div.onclick = () => loadConversation(user.id);
                        div.innerHTML = `
                            <img src="<?= base_url('uploads/') ?>${user.profile_pic ?? 'default.png'}" alt="avatar">
                            <div>${user.name}</div>
                        `;
                        list.appendChild(div);
                    });
                });
        }
    }

    function resetSearch() {
        document.getElementById('searchInput').value = '';
        loadContacts();
    }

    function loadContacts() {
        fetch(`<?= base_url('chat/getContacts') ?>`)
            .then(res => res.json())
            .then(contacts => {
                const list = document.getElementById('contactList');
                list.innerHTML = '';

                contacts.forEach(contact => {
                    const div = document.createElement('div');
                    div.className = 'user';
                    div.onclick = () => loadConversation(contact.id);
                    div.innerHTML = `
                        <img src="<?= base_url('uploads/') ?>${contact.profile_pic ?? 'default.png'}" alt="avatar">
                        <div>${contact.name}</div>
                    `;
                    list.appendChild(div);
                });
            });
    }

    // 🎤 Voice message handler tetap
    let recorder;
    let audioChunks = [];
    const recordBtn = document.getElementById('recordBtn');

    recordBtn.addEventListener('click', async () => {
        if (!recorder || recorder.state === 'inactive') {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            recorder = new MediaRecorder(stream);
            recorder.start();
            audioChunks = [];

            recorder.addEventListener('dataavailable', e => {
                audioChunks.push(e.data);
            });

            recorder.addEventListener('stop', () => {
                const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
                const formData = new FormData();
                formData.append('receiver_id', currentTarget);
                formData.append('voice', audioBlob, 'voice_message.webm');

                fetch('<?= base_url('chat/sendVoice') ?>', {
                    method: 'POST',
                    body: formData
                }).then(() => {
                    loadConversation(currentTarget);
                });
            });

            recordBtn.textContent = '🛑';
        } else {
            recorder.stop();
            recordBtn.textContent = '🎤';
        }
    });
</script>
</body>

</html>