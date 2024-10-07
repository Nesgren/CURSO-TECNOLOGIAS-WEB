<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationResponse extends Notification
{
    use Queueable;

    protected $invitation;
    protected $status;

    public function __construct($invitation, $status)
    {
        $this->invitation = $invitation;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $message = $this->status === 'accepted' 
            ? 'El empleado ha aceptado tu invitación.' 
            : 'El empleado ha rechazado tu invitación.';

        return (new MailMessage)
                    ->line($message)
                    ->line('Empleado: ' . $this->invitation->user->name)
                    ->line('Email: ' . $this->invitation->user->email);
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->status === 'accepted' 
                ? 'Un empleado ha aceptado tu invitación.' 
                : 'Un empleado ha rechazado tu invitación.',
            'invitation_id' => $this->invitation->id,
            'status' => $this->status,
        ];
    }
}