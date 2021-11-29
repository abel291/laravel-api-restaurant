<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'name',
        'portion_size',
        'calories',
        'allergies',
        'slug',
        'description_min',
        'img',
        'banner',
        'stars',
        'price_default',
        'max_quantity',
        'offer',
        'price',
        'type',
        'active',
        'stock',

    ];
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shopping_cart(){
        return $this->belongsToMany(Product::class,'shopping_cart')->withPivot('quantity')->withTimestamps();
    }
}
