<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Investments extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'investments'
    ];
    public $timestamps = false;

    protected $casts = [
        'investments' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }
}
