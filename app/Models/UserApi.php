<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApi extends Model
{
    use HasFactory;

    protected $table = 'user_apis';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'scn',
        'yoc',
    ];
}