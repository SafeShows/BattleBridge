<?php

namespace App\Models\Orbat;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Platoon extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = "id";
    
    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    function squads() {
        return $this->hasMany(Squad::class);
    }

    function company() {
        return $this->belongsTo(Company::class);
    }

    function members() {
        return $this->hasMany(User::class);
    }
}
