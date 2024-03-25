<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class CreateUserNotification extends Notification
{
    use Queueable;

    public $authUser;
    public $newUser;

    /**
     * Create a new notification instance.
     */
    public function __construct($authUser, $newUser)
    {
        $this->authUser = $authUser;
        $this->newUser = $newUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return [
            ''
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Nova conta de acesso criada para o email pelo usuário '.$this->authUser->name.'',
            'body' => 'Uma nova conta de acesso ao Painel Administrativo foi criada para o email '.$this->newUser->email.''
        ];
    }
}
