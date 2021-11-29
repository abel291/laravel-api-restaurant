<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'img',
        'alt_img',
        'title',
        'breadcrumb',
        'created_at',
        'updated_at',
    ];
}
