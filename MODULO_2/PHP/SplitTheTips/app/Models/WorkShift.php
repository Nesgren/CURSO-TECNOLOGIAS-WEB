<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'start_time', 'end_time', 'employee_id', 'company_id', 'hours_worked', 'area_id']; // Asegúrate de incluir area_id aquí

    protected $table = 'work_shifts';

    protected $dates = ['date'];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'hours_worked' => 'float',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Agrega la relación con Area
    public function area()
    {
        return $this->belongsTo(Area::class); // Asegúrate de que exista un modelo Area
    }
}
