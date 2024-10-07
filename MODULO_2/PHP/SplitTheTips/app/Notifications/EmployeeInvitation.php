<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\WorkShift;

class WorkShiftAssigned extends Notification
{
    use Queueable;

    protected $workShift;

    public function __construct(WorkShift $workShift)
    {
        $this->workShift = $workShift;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $url = url('/employee/work-shifts/' . $this->workShift->id);
        
        return (new MailMessage)
                    ->line('Se te ha asignado un nuevo turno de trabajo.')
                    ->line('Fecha: ' . $this->workShift->date->format('d/m/Y'))
                    ->line('Hora de inicio: ' . $this->workShift->start_time)
                    ->line('Hora de fin: ' . $this->workShift->end_time)
                    ->action('Ver detalles del turno', $url)
                    ->line('Si tienes alguna pregunta, por favor contacta a tu supervisor.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Se te ha asignado un nuevo turno de trabajo.',
            'work_shift_id' => $this->workShift->id,
            'date' => $this->workShift->date->format('d/m/Y'),
            'start_time' => $this->workShift->start_time,
            'end_time' => $this->workShift->end_time,
        ];
    }
}