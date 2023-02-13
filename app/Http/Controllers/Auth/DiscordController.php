<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppSettings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    private $appSettings = [];

    public function __construct()
    {
        $_appSettings =  AppSettings::all();

        foreach($_appSettings as $setting) {
            $this->appSettings[$setting->key] = $setting->value;
        }
    }

    public function redirect() {
        $config = [
            'client_id'    => $this->appSettings['discordClientID'],
            'client_secret' => Crypt::decryptString($this->appSettings['discordSecret']),
            'redirect'     => url('/auth/discord/callback'),
            'allow_gif_avatars' => false,
            'avatar_default_extension' => 'png'
        ];
        return Socialite::buildProvider(\SocialiteProviders\Discord\Provider::class, $config)->scopes([
            'identify',
            'email',
            'guilds.join',
        ])->redirect();
    }

    public function login() {
        $config = [
            'client_id'    => $this->appSettings['discordClientID'],
            'client_secret' => Crypt::decryptString($this->appSettings['discordSecret']),
            'redirect'     => url('/auth/discord/callback'),
            'allow_gif_avatars' => false,
            'avatar_default_extension' => 'png'
        ];
        $data = Socialite::buildProvider(\SocialiteProviders\Discord\Provider::class, $config)->user();

        if($user = User::where('discord_id', $data->id)->first()) {
            Auth::login($user);
        } else {
            if (User::all()->count() == 0) {
                $user = new User();
                $user->avatar = $user->discord_avatar = $data->avatar;
                $user->discord_id = $data->id;
                $user->name = $data->name;
                $user->save();
                $user->assignRole('Super Admin');
                $user->save();
                Auth::login($user);
            } else {
                $user = new User();
                $user->avatar = $user->discord_avatar = $data->avatar;
                $user->discord_id = $data->id;
                $user->name = $data->name;
                $user->save();
                Auth::login($user);
            }
        }

        return redirect("/");

    }
}
