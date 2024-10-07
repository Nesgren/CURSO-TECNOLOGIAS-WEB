<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invitation extends Model
{
    protected $fillable = ['email', 'status', 'company_id', 'area_id', 'token'];

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
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}