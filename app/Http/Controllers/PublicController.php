<?php

namespace App\Http\Controllers;

use App\Models\AppSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicController extends Controller
{
    public function index()
    {
        $appSettings = [];
        $_appSettings =  AppSettings::all();

        foreach($_appSettings as $setting) {
            $appSettings[$setting->key] = $setting->value;
        }

        return Inertia::render('index', [
            'AppSettings' => $appSettings
        ]);
    }
}
