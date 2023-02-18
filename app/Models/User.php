<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Orbat\Company;
use App\Models\Orbat\Fireteam;
use App\Models\Orbat\Platoon;
use App\Models\Orbat\Squad;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuids;
    use HasRoles;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [
        'teamspeak_key',
    ];

    public function platoon()
    {
        return $this->belongsTo(Platoon::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function squad()
    {
        return $this->belongsTo(Squad::class);
    }

}
