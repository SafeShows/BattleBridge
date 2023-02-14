<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller as BaseController;
use App\Models\AppSettings;
use Inertia\Inertia;

class Controller extends BaseController
{
    private $appSettings = [];

    public function __construct()
    {
        $_appSettings = AppSettings::all();

        foreach ($_appSettings as $setting) {
            $this->appSettings[$setting->key] = $setting->value;
        }
    }

    public function index()
    {
        return Inertia::render('index');
    }
}
