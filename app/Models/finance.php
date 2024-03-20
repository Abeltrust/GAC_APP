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
        'deduct_monthly',
        'approved_by',
        'applied_by',
        'last_deduction',
        'start_month',
        'status'];
}
