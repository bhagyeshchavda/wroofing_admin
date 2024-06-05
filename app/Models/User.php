<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\ColumnFillable;

class User extends Authenticatable
{
    use Notifiable, ColumnFillable, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $primaryKey = 'id';
    // Remove the next line
    // public $incrementing = false;

    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'profile_image', 'role', 'user_type', 'remember_token', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Remove the boot method and the setUserId method
     */
}
