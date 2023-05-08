<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    use HasFactory;

    public $incrementing = False;

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function data(){
        return $this->hasOne(CustomerData::class);
    }

    protected $table = 'customers';
}
