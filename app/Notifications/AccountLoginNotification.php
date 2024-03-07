<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountLoginNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $user;
    public $accessDetails;

    public function __construct($user, $accessDetails)
    {
        $this->user = $user;
        $this->accessDetails = $accessDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/forgot_password');

        return (new MailMessage)
                ->subject('OverFood - Novo acesso em sua conta')
                ->greeting('Olá '.$this->user->name.'!')
                ->line('Nós detectamos um novo acesso em sua conta na OverFood!')
                ->line('Caso não tenha sido você, altere sua senha imediatamente clicando no botão abaixo.')
                ->action('Alterar Senha', $url)
                ->line($this->accessDetails);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Novo acesso em sua conta',
            'body' => $this->accessDetails.' Caso não tenha sido você, altere sua senha imediatamente.'
        ];
    }
}
