<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;

    public $token;
    public $nome;
    public $email;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $nome, $email)
    {
        $this->token = $token;
        $this->nome = $nome;
        $this->email = $email;
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
        $saudacao = 'Olá, '.$this->nome;
        $url = 'http://localhost:8000/password/reset/'.$this->token.'?email='.$this->email;
        $tempo_expiracao = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
            ->subject('Redefinição de Senha')
            ->greeting($saudacao)
            ->line('Segue o link para a redefinição da sua senha:')
            ->action('Redefinir senha', url($url))
            ->line('O link expirará em ' . $tempo_expiracao . ' minutos.')
            ->salutation('Obrigado por utilizar nossa aplicação!');
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
