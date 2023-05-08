<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'color_id',
        'brand_id',
        'discount',
        'price',
    ];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function category(){
        return $this->hasOne(ProductToCategory::class);
    }

    public function brand(){
        return $this->hasOne(Brand::class);
    }

    public function color(){
        return $this->hasOne(Color::class);
    }

    public function configurations(){
        return $this->hasMany(ProductConfiguration::class);
    }

    public function reviews() {
        return $this->hasMany(ProductReview::class);
    }

    protected $table = 'products';
}
