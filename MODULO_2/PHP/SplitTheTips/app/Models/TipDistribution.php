<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipDistribution extends Model
{
    use HasFactory;

    protected $fillable = ['tip_pool_id', 'employee_id', 'area_id', 'amount'];

    public function tipPool()
    {
        return $this->belongsTo(TipPool::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}