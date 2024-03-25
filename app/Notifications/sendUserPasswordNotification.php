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

    public $authUser;
    public $newUser;
    public $passwordToMail;

    /**
     * Create a new notification instance.
     */
    public function __construct($authUser, $newUser, $passwordToMail)
    {
        $this->authUser = $authUser;
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
            ->subject('OverFood - Nova conta de acesso ao Painel Administrativo')
            ->greeting('Olá '.$this->newUser->name.'!')
            ->line('Informamos que uma nova conta de acesso ao Painel Administrativo da OverFood foi criada para você!')
            ->line('Acesse o painel clicando no botão abaixo e utilize a senha '.$this->passwordToMail.'. para acessar sua conta')
            ->action('Acessar', $url)
            ->line('Após isso recomendamos que altere sua senha através do Painel')
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
