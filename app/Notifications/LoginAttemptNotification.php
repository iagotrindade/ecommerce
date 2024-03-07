<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginAttemptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $userData;
    public $hash;
    public $accessDetails;

    public function __construct($user, $accessDetails)
    {
        $this->userData = $user;
        $this->hash = $user->login_hash;
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
                    ->subject('OverFood - Nova Tentativa de acesso')
                    ->greeting('Olá '.$this->userData->name.'!')
                    ->line('Nós detectamos uma nova tentativa de Login em sua conta na Saber Online!')
                    ->line('Utilize o código '.$this->hash.' para realizar o acesso.')
                    ->line('Esse código irá expirar em 3 (três) minutos.')
                    ->line('Caso não seja você que está tentando acessar sua conta, recomendamos alterar imediatamente sua senha clicando no botão abaixo e/ou entrar em contato com o suporte.')
                    ->line($this->accessDetails)
                    ->action('Alterar Senha', $url);
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
