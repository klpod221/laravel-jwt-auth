<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NotifyAdmin extends Notification implements ShouldQueue
{
    use Queueable;

    protected $userTarget;

    /**
     * Create a new notification instance.
     *
     * @param $userTarget
     */
    public function __construct(User $userTarget)
    {
        $this->userTarget = $userTarget;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $userTargetName = $this->userTarget->name;
        $userTargetType = $this->getUserTypeText($this->userTarget->type);

        return [
            // Required information
            'data' => "{'name':$userTargetName, 'type':$userTargetType}",
            'type' => $this->getNotificationType($this->userTarget->type),
            'target_id' => $this->userTarget->id,
        ];
    }

    /**
     * @param $type
     * @return string
     */
    private function getUserTypeText($type)
    {
        switch ($type) {
            case User::TYPE_CANDIDATE:
                return 'ung vien';
                break;
            default:
                return '';
        }
    }

    /**
     * @param $type
     * @return string
     */
    private function getNotificationType($type)
    {
        switch ($type) {
            case User::TYPE_CANDIDATE:
                return config('option.notification_type.new_candidate.id');
                break;
            default:
                return null;
        }
    }
}
