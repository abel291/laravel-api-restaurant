<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'active'
    ];
    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'active' => 'boolean',

    ];
    protected $hidden = ["created_at", "updated_at"];
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
