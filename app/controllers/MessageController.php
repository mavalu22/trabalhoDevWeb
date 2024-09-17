<?php

namespace App\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;
use App\Models\Messages;

class MessageController
{
    private $userModel;
    private $messagesModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->messagesModel = new Messages();
    }

    public function showSendMessage()
    {
        require __DIR__ . '/../views/message/send.php';
    }

    public function searchRecipient()
    {
        $query = $_GET['query'] ?? '';
        if (!empty($query)) {
            $recipients = $this->userModel->searchUsersByName($query);
            foreach ($recipients as $recipient) {
                if ($recipient['username'] != $_SESSION['username']) {
                    echo "<div onclick=\"selectRecipient('{$recipient['username']}')\">{$recipient['username']}</div>";
                }
            }
        }
    }

    public function sendMessage()
    {
        $recipients = $_POST['recipients'] ?? '';
        $subject = $_POST['subject'] ?? '';
        $message = $_POST['message'] ?? '';
        $sender_id = $_SESSION['user_id'] ?? '';
        
        if ($recipients && $subject && $message && $sender_id) {
            $recipientsArray = explode(',', $recipients);
            
            $recipient_ids = [];
            foreach ($recipientsArray as $recipient_username) {
                $recipient_user = $this->userModel->findByUsernameOrEmail($recipient_username);
                if ($recipient_user) {
                    $recipient_ids[] = $recipient_user['id'];
                }
            }

            if (!empty($recipient_ids)) {
                try {
                    $this->messagesModel->sendMessage($sender_id, $recipient_ids, $subject, $message);
                    header('Location: index.php?action=home');
                    exit();
                } catch (\Exception $e) {
                    echo "Failed to send message: " . $e->getMessage();
                }
            } else {
                echo "No valid recipients found.";
            }
        } else {
            echo "All fields are required!";
        }
    }

    public function showHome()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        if ($user_id) {

            $messages = $this->messagesModel->getReceivedMessages($user_id);
            require __DIR__ . '/../views/user/home.php';
        } else {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function viewMessage()
{
    $message_id = $_GET['id'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;

    if ($message_id && $user_id) {
        $message = $this->messagesModel->getMessageById($message_id, $user_id);

        if ($message) {
            $this->messagesModel->markMessageAsRead($message_id, $user_id);
            require __DIR__ . '/../views/message/view.php';
        } else {
            echo "Message not found or you don't have permission to view it.";
        }
    } else {
        echo "Invalid message ID.";
    }
}

public function deleteMessage()
{
    $message_id = $_POST['message_id'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;

    if ($message_id && $user_id) {
        try {
            $this->messagesModel->deleteMessage($message_id, $user_id);
            header('Location: index.php?action=home');
        } catch (\Exception $e) {
            echo "Failed to delete message: " . $e->getMessage();
        }
    } else {
        echo "Invalid request. Message could not be deleted.";
    }
}

}
