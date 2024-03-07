<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordActionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $userName;
    public $accessDetails;

    public function __construct($userName, $accessDetails)
    {
        $this->userName = $userName;
        $this->accessDetails = $accessDetails;
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
        $url = url('/forgot_password');

        return (new MailMessage)
                ->subject('OverFood - Nova alteração de senha')
                ->greeting('Olá '.$this->userName.'!')
                ->line('Nós detectamos uma nova alteração de senha em sua conta na Saber Online!')
                ->line('Caso não tenha sido você que solicitou essa mudança, recomendamos alterar imediatamente sua senha clicando no botão abaixo e/ou entrar em contato com o suporte.')
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
            //
        ];
    }
}
