<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'seo_metas';

    protected $fillable = [
        'object_type',
        'object_id',
        'meta_title',
        'meta_description',
    ];
    
}
