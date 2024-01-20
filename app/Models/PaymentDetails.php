<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'amount',
        'count',
        'staffId',
        ];

       

        public function user()
        {
            return $this->belongsTo(User::class, 'scn', 'scn');
        }
}
