<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'scn',
        'amount',
        'status',
        'transaction_date',
        'transaction_id',
        ];

       

        public function user()
        {
            return $this->belongsTo(User::class, 'scn', 'scn');
        }
}
