<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Captain extends Authenticatable implements JWTSubject
// {
//     use HasApiTokens, HasFactory, Notifiable;


//     protected $fillable = [

//         'first_name',
//         'last_name',
//         'phone',
//         'email',
//         'vehicle',
//         'rate',
//         'licence_plate',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var array<int, string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];




//     /**
//      * Get the identifier that will be stored in the subject claim of the JWT.
//      *
//      * @return mixed
//      */
//     public function getJWTIdentifier()
//     {
//         return $this->getKey();
//     }

//     /**
//      * Return a key value array, containing any custom claims to be added to the JWT.
//      *
//      * @return array
//      */
//     public function getJWTCustomClaims()
//     {
//         return [];
//     }

//     public function trip()
//     {
//         return $this->hasMany(Trip::class, 'captain_id');
//     }
// }
class Captain extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [

        'first_name',
        'last_name',
        'phone',
        'email',
        'vehicle',
        'rate',
        'licence_plate',
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function trip()
    {
        return $this->hasMany(Trip::class, 'captain_id');
    }
}
