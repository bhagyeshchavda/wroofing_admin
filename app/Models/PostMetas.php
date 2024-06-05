<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMetas extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'meta_key',
        'meta_value'
    ];
    protected $searchFields = [
        'post_id',
    ];
}
