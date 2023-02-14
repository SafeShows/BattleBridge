<?php

use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Community\InstallerController;
use App\Http\Controllers\Community\OrbatController;
use App\Http\Controllers\Public\Controller as PublicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(InstallerController::class)->prefix('/installer')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'install');
});

Route::middleware(['installer'])->group(function () {
    Route::controller(PublicController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::controller(OrbatController::class)->prefix('/orbat')->group(function () {
        Route::get('/', 'index');
    });

    Route::prefix('/auth')->group(function () {
        Route::controller(DiscordController::class)->group(function () {
            Route::get('/discord', 'redirect');
            Route::get('/discord/callback', 'login');
        });
    });
});

Route::get('/test', function (Request $req) {
    // try
    // {
    //     // IPv4 connection URI
    //     $uri = "serverquery://serveradmin:tiu4lcTq@127.0.0.1:10011/?server_port=9987";

    //     /**
    //      * @var TeamSpeak3_Node_Host
    //      */
    //     $ts3_VirtualServer = TeamSpeak3::factory($uri);
    //     //

    //     $ts3_Channel = $ts3_VirtualServer->logView();

    //     foreach ($ts3_Channel as $log) {
    //         preg_match_all("/(([\w])\w*)\) used privilege key '(([\w])\w*)/", $log['l'], $data);
    //     }
    //     echo 'ID: '.$data[1][0]."<br />Key: ".$data[3][0];
    // }
    // catch(TeamSpeak3_Exception $e)
    // {
    //     // print the error message returned by the server
    //     echo "Error " . $e->getCode() . ": " . $e->getMessage();
    // }

    dd($req);
});
