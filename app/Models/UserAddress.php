<?php

namespace App\Models;

use Nnjeim\World\Models\Country;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
