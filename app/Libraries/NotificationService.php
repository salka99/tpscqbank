<?php 
namespace App\Libraries;

class NotificationService
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function create($data, $userIds = [])
    {
        $this->db->table('notifications')->insert($data);
        $nid = $this->db->insertID();

        if ($data['target_type'] === 'specific') {
            foreach ($userIds as $uid) {
                $this->db->table('notification_targets')->insert([
                    'notification_id' => $nid,
                    'user_id' => $uid
                ]);
            }
        }
        return $nid;
    }

    public function getUserNotifications($userId)
    {
        return $this->db->query("
            SELECT n.*, nr.is_read, nr.is_seen
            FROM notifications n
            LEFT JOIN notification_reads nr 
                ON nr.notification_id = n.id AND nr.user_id = ?
            LEFT JOIN notification_targets nt 
                ON nt.notification_id = n.id
            WHERE 
                n.target_type = 'all'
                OR (n.target_type = 'single' AND n.user_id = ?)
                OR (n.target_type = 'specific' AND nt.user_id = ?)
            GROUP BY n.id
            ORDER BY n.id DESC
            LIMIT 20
        ", [$userId, $userId, $userId])->getResultArray();
    }

    public function markSeen($nid, $uid)
    {
        $this->save($nid, $uid, ['is_seen' => 1, 'seen_at' => date('Y-m-d H:i:s')]);
    }

    public function markRead($nid, $uid)
    {
        $this->save($nid, $uid, ['is_read' => 1, 'read_at' => date('Y-m-d H:i:s')]);
    }

    private function save($nid, $uid, $data)
    {
        $row = $this->db->table('notification_reads')
            ->where(['notification_id' => $nid, 'user_id' => $uid])
            ->get()->getRow();

        if ($row) {
            $this->db->table('notification_reads')->where('id', $row->id)->update($data);
        } else {
            $this->db->table('notification_reads')->insert(array_merge([
                'notification_id' => $nid,
                'user_id' => $uid
            ], $data));
        }
    }
}