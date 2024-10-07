<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Area extends Model
{
    
    use HasFactory;

    protected $fillable = ['name', 'tip_percentage', 'company_id'];
    protected $casts = [
        'date' => 'date',
        'tip_percentage' => 'float',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function tips()
    {
    return $this->hasManyThrough(Tip::class, Employee::class);
    }
    public function tipDistributions()
    {
    return $this->hasMany(TipDistribution::class);
    }
}