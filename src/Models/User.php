<?php

namespace App\Models;

use App\Database\Database;

class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->connect();
    }

    // Listar todos os usuários
    public function getAll() {
        $stmt = $this->db->query('SELECT * FROM users');
        return $stmt->fetchAll();
    }

    // Listar um usuário pelo ID
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Adicionar um novo usuário
    public function add($data) {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, status, admission_date) VALUES (?, ?, ?, ?)');
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['status'],
            $data['admission_date']
        ]);
    }

    // Atualizar um usuário existente
    public function update($data) {
        $stmt = $this->db->prepare('UPDATE users SET name = ?, email = ?, status = ?, admission_date = ? WHERE id = ?');
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['status'],
            $data['admission_date'],
            $data['id']
        ]);
    }

    // Deletar um usuário
    public function delete($id) {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }

    // Listar usuários com filtros
    public function filter($filters) {
        $query = "SELECT * FROM users WHERE 1=1";
        $params = [];
    
        if (!empty($filters['name'])) {
            $query .= " AND name LIKE :name";
            $params[':name'] = '%' . $filters['name'] . '%';
        }
    
        if (!empty($filters['email'])) {
            $query .= " AND email LIKE :email";
            $params[':email'] = '%' . $filters['email'] . '%';
        }
    
        if (!empty($filters['status'])) {
            $query .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }
    
        if (!empty($filters['admission_date'])) {
            $query .= " AND admission_date = :admission_date";
            $params[':admission_date'] = $filters['admission_date'];
        }
    
        if (!empty($filters['created_at'])) {
            $query .= " AND DATE(created_at) = :created_at";
            $params[':created_at'] = $filters['created_at'];
        }
    
        if (!empty($filters['updated_at'])) {
            $query .= " AND DATE(updated_at) = :updated_at";
            $params[':updated_at'] = $filters['updated_at'];
        }
    
        $stmt = $this->db->prepare($query);
        foreach ($params as $key => &$val) {
            $stmt->bindParam($key, $val);
        }
        $stmt->execute();
    
        return $stmt->fetchAll();
    }
    
    
}
