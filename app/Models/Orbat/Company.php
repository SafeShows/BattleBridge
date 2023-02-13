<?php

namespace App\Models\Orbat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = "id";
    
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    function platoons() {
        return $this->hasMany(Platoon::class);
    }

    function members() {
        return $this->hasMany(User::class);
    }
}
