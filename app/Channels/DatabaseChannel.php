<?php

namespace App\Channels;

use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
use Illuminate\Notifications\Notification;

class DatabaseChannel extends IlluminateDatabaseChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return array
     */
    public function buildPayload($notifiable, Notification $notification)
    {
        $data = $this->getData($notifiable, $notification);
        $type = $data['type'] ?? null;
        $targetID = $data['target_id'] ?? null;
        $dataColum = $data['data'] ?? null;
        unset($data['title'], $data['type'], $data['target_id']);

        return [
            'id' => $notification->id,
            'type' => $type,
            'target_id' => $targetID,
            'data' => $dataColum,
            'read_at' => null,
        ];
    }
}
