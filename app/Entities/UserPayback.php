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
        return $this->hasMany('App\Entities\User');
    }

    public function history()
    {
        return $this->morphMany(History::class, 'my_model_table', 'reference_table', 'reference_id');
    }
}
