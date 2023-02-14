<?php

namespace App\Models\Orbat;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fireteam extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    public function squad()
    {
        return $this->belongsTo(Squad::class);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }
}
