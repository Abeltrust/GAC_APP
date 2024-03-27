<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class finance extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'amount', 
        'approved_by',
        'applied_by',
        'deduct_monthly',
        'start_month',
        'last_deduction',
        'status',
    ];
}
