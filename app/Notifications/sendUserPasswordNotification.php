<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class sendUserPasswordNotification extends Notification
{
    use Queueable;

    public $newUser;
    public $passwordToMail;

    /**
     * Create a new notification instance.
     */
    public function __construct($newUser, $passwordToMail)
    {
        $this->newUser = $newUser;
        $this->passwordToMail = $passwordToMail;
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
        $url = url('/adm');

        return (new MailMessage)
            ->subject('OverFood - Nova conta de acesso Criada')
            ->greeting('Olá '.$this->newUser->name.'!')
            ->line('Informamos que uma nova conta de acesso da OverFood foi criada para você!')
            ->line('Acesse sua conta clicando no botão abaixo e utilize a senha '.$this->passwordToMail.'')
            ->action('Acessar', $url)
            ->line('Após isso recomendamos que altere sua senha nas opções do seu usuário')
            ->line('Caso esse email não seja destinado a você pedimos gentilmente que o desconsidere');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            ''
        ];
    }
}
