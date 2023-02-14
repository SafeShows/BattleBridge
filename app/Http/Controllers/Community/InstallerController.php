<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class InstallerController extends Controller
{
    public function index()
    {
        return Inertia::render('installer/index');
    }

    public function install(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $value) {
            if ($key === 'discordSecret' || $key === 'discordBotToken' || $key === 'teamspeakServerQueryPassword') {
                AppSettings::create([
                    'key'  => $key,
                    'value'=> Crypt::encryptString($value),
                ]);
            } else {
                AppSettings::create([
                    'key'  => $key,
                    'value'=> $value,
                ]);
            }
        }

        $installed = AppSettings::where('key', 'installed')->first();
        $installed->value = '1';
        $installed->save();
        dd(AppSettings::all());
        // return Inertia::render('installer/index');
    }
}
