<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserPayback extends Model
{
    protected $table = 'user_paybacks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'percentage',
        'on'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function history()
    {
        return $this->hasMany('App\Entities\UserPaybackHistory');
    }
}
