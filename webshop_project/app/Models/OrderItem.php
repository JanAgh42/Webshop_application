<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function config(){
        return $this->belongsTo(ProductConfiguration::class,'config_id');
    }

    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $table = 'order_items';
}
