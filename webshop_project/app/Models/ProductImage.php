<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'image_url',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected $table = 'product_images';
}
