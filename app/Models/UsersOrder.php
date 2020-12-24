<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersOrder extends Model
{
    use HasFactory;

    protected $table = 'users_order';
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
    ];
}
