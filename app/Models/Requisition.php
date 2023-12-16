<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'unitPrice',
        'status',
        'quantity',
        'total',
        'applied_by',
        'approved_by',
        ];
}
