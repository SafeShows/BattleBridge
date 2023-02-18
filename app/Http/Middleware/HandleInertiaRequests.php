<?php

namespace App\Http\Middleware;

use App\Models\AppSettings;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function share(Request $request): array
    {
        $appSettings = [];
        $_appSettings = AppSettings::all();

        foreach ($_appSettings as $setting) {
            if (
                $setting->key === 'installed' ||
                $setting->key === 'discordClientID' ||
                $setting->key === 'discordSecret' ||
                $setting->key === 'discordBotToken' ||
                $setting->key === 'teamspeakServerIP' ||
                $setting->key === 'teamspeakServerPort' ||
                $setting->key === 'teamspeakServerQueryUsername' ||
                $setting->key === 'teamspeakServerQueryPassword' ||
                $setting->key === 'teamspeakServerQueryPort'

            ) {
                continue;
            } else {
                $appSettings[$setting->key] = $setting->value;
            }
        }
        if ($user = $request->user()) {
            $_roles = $user->roles()->getResults();
            $roles = [];
            foreach ($_roles as $role) {
                $r = new class() {
                    public string $name;
                    public array $permissions;
                };
                $r->name = $role->name;
                $r->permissions = [];
                $_permissions = $role->permissions()->getResults();
                foreach ($_permissions as $permission) {
                    $r->permissions[] = $permission->name;
                }
                $roles[] = $r;
            }
            $user->roles = $roles;
            $user->platoon = $user->platoon()->first();
            $user->company = $user->company()->first();
            $user->squad = $user->squad()->first();
            unset($user->teamspeak_key);
            unset($user->company_id);
            unset($user->platoon_id);
            unset($user->squad_id);
        // dd($roles);
        } else {
            $user = null;
        }

        return array_merge(parent::share($request), [
            'User'        => $user,
            'AppSettings' => $appSettings,
        ]);
    }
}
