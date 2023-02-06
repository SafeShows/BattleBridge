<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class InstallerController extends Controller
{
    public function index()
    {
        return Inertia::render('installer/index');
    }
}
