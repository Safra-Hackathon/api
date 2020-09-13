<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    protected $fillable = [
        'name',
        'category',
        'interest',
        'min',
        'admin_tax',
        'withdraw_time'
    ];

    public $timestamps = false;
}
