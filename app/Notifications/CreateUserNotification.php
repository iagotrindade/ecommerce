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
    private $authUser;
    private $user;
    private $password;

    /**
     * Create a new notification instance.
     */
    public function __construct($authUser, $user, $passwordToMail)
    {
        $this->authUser  = $authUser;
        $this->user  = $user;
        $this->password  = $passwordToMail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view(
            'mails.new_user_mail', [
                'userData' => $this->user,
                'password' => $this->password
            ])
            ->subject('Click Shopping - Nova conta de Acesso ao Painel Administrativo criada para você');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Nova Conta de Acesso Criada',
            'message' => 'O usuário '.$this->authUser->name.' criou uma conta para o E-mail '.$this->user->email.'!'
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Nova Conta de Acesso Criada',
            'message' => 'O usuário '.$this->authUser->name.' criou uma conta para o E-mail '.$this->user->email.'!'
        ];
    }
}
