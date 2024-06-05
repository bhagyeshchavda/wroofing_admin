<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFolder extends Model
{
    use HasFactory;
    protected $table = 'media_folders';
    protected $fillable = [
        'name',
        'folder_id',
        'type',
    ];

    public function files()
    {
        return $this->hasMany(MediaFile::class, 'folder_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(MediaFolder::class, 'folder_id', 'id');
    }

    public function deleteFolder()
    {
        foreach ($this->children as $child) {
            $child->deleteFolder();
        }

        foreach ($this->files as $file) {
            $file->delete();
        }

        return $this->delete();
    }

    public static function folderExists($name, $parentId)
    {
        return self::where('name', '=', $name)
            ->where('folder_id', '=', $parentId)
            ->exists();
    }
}
