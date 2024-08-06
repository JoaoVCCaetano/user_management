<?php

namespace App\Controllers;

use App\Models\User;
use WebSocket\Client as WebSocketClient;

class UserController {
    private $userModel;
    private $webSocketUrl = 'ws://websocket:9090';

    public function __construct(User $user) {
        $this->userModel = $user;
    }

    public function index() {
        $users = $this->userModel->getAll();
        include __DIR__ . '/../Views/userList.php';
    }

    public function create() {
        $user = null;
        include __DIR__ . '/../Views/userForm.php';
    }

    public function edit($id) {
        $user = $this->userModel->getById($id);
        include __DIR__ . '/../Views/userForm.php';
    }

    public function store($data) {
        if (isset($data['id']) && !empty($data['id'])) {
            $this->userModel->update($data);
            $_SESSION['message'] = [
                'title' => 'Success!',
                'text'  => 'User has been changed successfully.'
            ];
        } else {
            $this->userModel->add($data);
            $_SESSION['message'] = [
                'title' => 'Success!',
                'text'  => 'User has been saved successfully.'
            ];
        }

        $this->notifyWebSocketServer();

        header('Location: /users');
    }

    public function delete($id) {
        $this->userModel->delete($id);

        $_SESSION['message'] = [
            'title' => 'Success!',
            'text'  => 'User has been deleted successfully.'
        ];

        $this->notifyWebSocketServer();

        header('Location: /users');
    }

    public function filter() {
        $filters = [
            'name' => $_GET['name'] ?? null,
            'email' => $_GET['email'] ?? null,
            'status' => $_GET['status'] ?? null,
            'admission_date' => $_GET['admission_date'] ?? null,
            'created_at' => $_GET['created_at'] ?? null,
            'updated_at' => $_GET['updated_at'] ?? null
        ];
        
        $users = $this->userModel->filter($filters);
        echo json_encode($users);
    }

    private function notifyWebSocketServer() {

        try {
            // Cria uma conexão com o servidor WebSocket
            $client = new WebSocketClient($this->webSocketUrl);
    
            // Envia uma mensagem para o servidor WebSocket
            $client->send(json_encode(['action' => 'update']));
    
            // Fecha a conexão
            $client->close();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

    }
}
