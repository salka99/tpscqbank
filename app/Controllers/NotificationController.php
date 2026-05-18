<?php
namespace App\Controllers;

use App\Libraries\NotificationService;

class NotificationController extends BaseController
{
    public function get()
    {
        $service = new NotificationService();
        $userId = session()->get('user_id');

        return $this->response->setJSON(
            $service->getUserNotifications($userId)
        );
    }

    public function seen($id)
    {
        $service = new NotificationService();
        $service->markSeen($id, session()->get('user_id'));
    }

    public function read($id)
    {
        $service = new NotificationService();
        $service->markRead($id, session()->get('user_id'));
    }

    public function create(){
        $service = new \App\Libraries\NotificationService();

        // test admin to all
        $service->create([
            'title' => 'Welcome',
            'message' => 'This is test notification',
            'type' => 'info',
            'target_type' => 'all'
        ]);

        // test single user
        $service->create([
            'title' => 'Approved',
            'message' => 'Your request approved',
            'type' => 'success',
            'target_type' => 'single',
            'user_id' => 1
        ]);
            }
}