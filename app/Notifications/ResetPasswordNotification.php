<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public $token;
    public $url;

    public function __construct($token, $url = null)
    {
        $this->token = $token;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = $this->url ?? "https://gym-tracker-black-delta.vercel.app/auth/reset-password/{$this->token}?email=" . urlencode($notifiable->getEmailForPasswordReset());
    
        return (new MailMessage)
            ->subject('Recuperación de contraseña')
            ->greeting('¡Hola!')
            ->line('Recibimos una solicitud para restablecer tu contraseña.')
            ->action('Restablecer contraseña', $url)
            ->line('Este enlace expirará en 60 minutos.')
            ->line('Si no solicitaste este cambio, ignora este mensaje.');
    }
    
}
