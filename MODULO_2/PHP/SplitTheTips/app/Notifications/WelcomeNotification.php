<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function __construct()
    {

    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Bienvenido a SplitTheTips!')
                    ->action('Visita tu dashboard', url('/dashboard'))
                    ->line('Gracias por unirte a nosotros!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Bienvenido a SplitTheTips!',
        ];
    }
}