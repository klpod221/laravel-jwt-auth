<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\User;
use App\Services\UserService;
use App\Events\User\UserCreated;
use App\Events\User\UserLoggedIn;
use Illuminate\Support\Facades\Log;
use App\Notifications\User\VerifySms;
use App\Notifications\User\NotifyAdmin;
use App\Notifications\User\VerifyEmail;
use App\Utils\OptionUtility;
use Illuminate\Support\Facades\Notification;

class UserEventListener
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserEventListener constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UserCreated $event
     */
    public function onCreated(UserCreated $event)
    {
        $user = $event->user;
        $this->createActivityLog($user, config('option.activity_type.create.id'));
        $user->notify(new VerifyEmail());
        // Sms nexmo
        // $user->notify(new VerifySms());
        $this->notifyToAdmin($user);
    }

    /**
     * @param User $user
     * @param $type
     */
    private function createActivityLog(User $user, $type)
    {
        // Create activity log for job action
        $actionName = option()->get("activity_type", $type)['value'] ?? 'undefined';
        \Log::info("Creating activity log with type  \"$actionName\" with user \"$user->name\"!");
    }

    /**
     * @param $userTarget
     */
    private function notifyToAdmin($userTarget)
    {
        $adminUsers = $this->userService->getAdministrators();
        Notification::send($adminUsers, new NotifyAdmin($userTarget));
    }

    /**
     * @param UserLoggedIn $event
     */
    public function onLoggedIn(UserLoggedIn $event)
    {
        $user = $event->user;
        $user->access()->update([
            'last_login_at' => carbon()->now()
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UserCreated::class,
            'App\Listeners\UserEventListener@onCreated',
        );

        $events->listen(
            UserLoggedIn::class,
            'App\Listeners\UserEventListener@onLoggedIn',
        );
    }
}
