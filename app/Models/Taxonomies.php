<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Taxonomies extends Model
{
    use HasFactory;
//    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
        'post_type',
        'taxonomy',
        'parent_id',
        'total_post',
        'level',
    ];
    protected $searchFields = [
        'name',
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
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
