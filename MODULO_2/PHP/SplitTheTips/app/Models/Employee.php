<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'company_id',
        'area_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function tips()
    {
        return $this->hasMany(Tip::class);
    }
    public function invitations()
    {
    return $this->hasMany(Invitation::class);
    }
    public function tipDistributions()
    {
    return $this->hasMany(TipDistribution::class);
    }
    public function workShifts()
    {
        return $this->hasMany(WorkShift::class);
    }    
}