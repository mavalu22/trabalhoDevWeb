<?php

namespace App\Models;

require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use App\Services\Database;

class Messages
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance();
    }

    public function sendMessage($sender_id, $recipients, $subject, $messageContent)
    {
        try {
            $this->conn->beginTransaction();
            
            $sql = "INSERT INTO messages (user_id, subject, message) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$sender_id, $subject, $messageContent]);

            $message_id = $this->conn->lastInsertId();
            
            $sql = "INSERT INTO message_user (message_id, user_id) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);

            foreach ($recipients as $recipient_id) {
                $stmt->execute([$message_id, $recipient_id]);
            }
            
            $this->conn->commit();
            
            return true;
        } catch (\Exception $e) {
            $this->conn->rollBack();
            throw new \Exception("Error sending message: " . $e->getMessage());
        }
    }

    public function getReceivedMessages($user_id)
    {
        $sql = "SELECT m.id, m.subject, m.message, m.send_datetime, u.username AS sender, mu.read_status
                FROM messages m
                JOIN message_user mu ON m.id = mu.message_id
                JOIN users u ON m.user_id = u.id
                WHERE mu.user_id = ? 
                ORDER BY m.send_datetime DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function markMessageAsRead($message_id, $user_id)
    {
        $sql = "UPDATE message_user SET read_status = 1 WHERE message_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$message_id, $user_id]);
    }

    public function getMessageById($message_id, $user_id)
    {
        $sql = "SELECT m.id, m.subject, m.message, m.send_datetime, u.username AS sender 
                FROM messages m
                JOIN message_user mu ON m.id = mu.message_id
                JOIN users u ON m.user_id = u.id
                WHERE m.id = ? AND mu.user_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$message_id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteMessage($message_id, $user_id)
    {
        $sql = "DELETE FROM message_user WHERE message_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$message_id, $user_id]);

        $sql = "DELETE FROM messages WHERE id = ? AND NOT EXISTS (SELECT 1 FROM message_user WHERE message_id = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$message_id, $message_id]);
    }


}
