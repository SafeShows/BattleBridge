<?php

namespace App\Models\Orbat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Squad extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = "id";
    
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    function fireteams() {
        return $this->hasMany(Fireteam::class);
    }

    function platoon() {
        return $this->belongsTo(Platoon::class);
    }

    function members() {
        return $this->hasMany(User::class);
    }
}
