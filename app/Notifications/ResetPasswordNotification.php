<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $resetUrl;
    public $userName;

    public function __construct($resetUrl, $userName)
    {
        $this->resetUrl = $resetUrl;
        $this->userName = $userName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('OverFood - Nova solicitação de mudança de senha')
                ->greeting('Prezado '.$this->userName.'!')
                ->line('Nós detectamos uma nova solicitação de mudança de senha em sua conta na Saber Online!')
                ->line('Clique no botão abaixo para completar a alteração.')
                ->action('Alterar Senha', $this->resetUrl)
                ->line('Caso não tenha sido você, por favor, desconsidere esta mensagem e/ou contate o suporte.')
                ->line('Localização do acesso Indeterminada');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
