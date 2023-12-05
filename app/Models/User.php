<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Permission;
use App\Models\PaymentDetails;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'scn',           
       'title',       
       'role',           
       'firstname',      
       'lastName' ,      
       'middlename',     
       'phoneNumber',     
       'yearOfCallToBar', 
       'gender',          
       'organization',    
       'address',         
       'email',           
       'password',        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function permission():HasOne
    {
        return $this->hasOne(Permission::class,'scn','scn');
    }
    public function paymentDetails():HasMany
    {
        return $this->hasMany(PaymentDetails::class,'scn','scn');
    }
}