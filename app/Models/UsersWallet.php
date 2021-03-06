<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersWallet extends Model
{
    use HasFactory;
    protected $table = 'users_wallet';
    protected $fillable = [
        'user_id',
        'wallet_balance',
    ];
}
