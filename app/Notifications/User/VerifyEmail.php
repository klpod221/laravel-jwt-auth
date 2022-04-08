<?php

namespace App\Notifications\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting("Xin chào $notifiable->name,")
            ->subject('Thông tin xác thực tài khoản')
            ->line('Cảm ơn bạn đã tin tưởng và sử dụng dịch vụ của Project, vui lòng nhấn vào nút bên dưới để xác nhận thông tin:')
            ->action('Xác nhận tài khoản', $this->getVerificationUrl($notifiable))
            ->line('Sau khi xác nhận thành công bạn có thể sử dụng tài khoản để đăng nhập và sử dụng tại địa chỉ website Project.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function getVerificationUrl($notifiable)
    {
        return config('const.callback_confirmation_url') . '/' . $notifiable->access->confirmation_code;
    }
}
