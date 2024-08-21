<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class EmailChangeNotification extends Notification
{
    use Queueable;

    /**
     * The email change token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('email.change.confirm', [
            'token' => $this->token,
        ], false));

        return (new MailMessage)
            ->subject(Lang::get('メールアドレス変更の確認'))
            ->line(Lang::get('このメールは、あなたのアカウントのメールアドレス変更リクエストを受け取ったためお送りしています。'))
            ->action(Lang::get('メールアドレスを変更'), $url)
            ->line(Lang::get('このメールアドレス変更リクエストの有効期限は :count 分です。', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('もしメールアドレスの変更をリクエストしていない場合は、このメールを無視してください。'));
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
}