<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'phone',
        'description',
        'user_id',
        'amount_usd',
        'amount_yr',
        'amount_sr',
    ];
}
