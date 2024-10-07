<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
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
        return ['database']; // Solo enviar a la base de datos
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