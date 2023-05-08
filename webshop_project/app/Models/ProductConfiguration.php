<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfiguration extends Model
{
    use HasFactory;

    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected $table = 'product_configs';
}
