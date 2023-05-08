<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $table = 'product_reviews';
}
