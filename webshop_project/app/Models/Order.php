<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function customerData(){
        return $this->belongsTo(CustomerData::class);
    }


    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $table = 'orders';
}
