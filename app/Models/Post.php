<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public const STATUS_PUBLISH = 'publish';
    public const STATUS_PRIVATE = 'private';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_TRASH = 'trash';

    protected $fillable = [
        'title',
        'content',
        'status',
        'views',
        'thumbnail',
        'slug',
        'description',
        'type',
        'json_metas',
        'templateStatus',
        'json_taxonomies',
        'rating',
        'total_rating',
        'lockunlockstatus',
    ];

    protected $searchFields = [
        'title',
    ];

    protected $casts = [
        'json_metas' => 'array',
        'json_taxonomies' => 'array',
    ];

    public function setSlugAttribute($value) {
        
        if (static::whereSlug($slug = $value)->exists()) {
    
            $slug = $this->incrementSlug($slug);
        }
    
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {

        $original = $slug;
    
        $count = 2;
    
        while (static::whereSlug($slug)->exists()) {
    
            $slug = "{$original}-" . $count++;
        }
    
        return $slug;
    
    }
}
