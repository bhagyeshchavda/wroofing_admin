<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Traits\ColumnFillable;

class Membership extends Authenticatable {

    use Notifiable;
    use ColumnFillable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false;
    
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'profile_picture', 'user_type', 'remember_token', 'status'
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
     * Set user id when creating new user
     */
    protected static function boot() {
        parent::boot();
        User::creating(function ($model) {
            $model->setUserId();
        });
    }

    public function setUserId() {
        $this->attributes['id'] = (string) Str::uuid();
    }

    public function getPictureAttribute($value){
        if($value){
            return asset('users/images/'.$value);
        }else{
            return asset('users/images/no-image.png');
        }
    }
}
