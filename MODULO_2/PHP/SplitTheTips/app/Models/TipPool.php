<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipPool extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'date',
        'total_amount',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tipDistributions()
    {
        return $this->hasMany(TipDistribution::class);
    }
}