<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    use HasFactory;

    public $timestamps = false;
        protected $fillable = [
            'name',
            'value',
        ];
}
