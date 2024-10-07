<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Company extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}