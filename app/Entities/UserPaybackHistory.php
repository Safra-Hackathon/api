<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserPaybackHistory extends Model
{
    protected $table = 'user_payback_history';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'percentage',
        'on'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->hasOne('App\Entities\User');
    }

    public function payback()
    {
        return $this->hasOne('App\Entities\User');
    }
}
