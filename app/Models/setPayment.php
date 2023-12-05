<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'branch',
        'idCard',
        'insurance',
        'total',
        ];
}
