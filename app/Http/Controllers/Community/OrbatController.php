<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\Orbat\Company;
use App\Models\Orbat\Platoon;
use App\Models\Orbat\Squad;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\QueryBuilder\QueryBuilder;

class OrbatController extends Controller
{
    public function index(Request $req)
    {
        $companies = QueryBuilder::for(Company::class)->with(['members', 'platoons', 'platoons.members', 'platoons.squads', 'platoons.squads.members', 'platoons.squads'])->get();
        $platoons = QueryBuilder::for(Platoon::class)->with(['squads', 'members', 'squads', 'company'])->get();
        $squads = QueryBuilder::for(Squad::class)->with(['members', 'platoon', 'platoon.company'])->get();

        return Inertia::render('community/orbat/index', [
            'companies' => $companies,
            'platoons'  => $platoons,
            'squads'    => $squads,
        ]);
    }
}
