<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use \App\Models\AppSettings;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [];
        
        $permissions[] = Permission::findOrCreate("orbat.view");
        $permissions[] = Permission::findOrCreate("orbat.update");
        
        $permissions[] = Permission::findOrCreate("company.view");
        $permissions[] = Permission::findOrCreate("company.create");
        $permissions[] = Permission::findOrCreate("company.update");
        $permissions[] = Permission::findOrCreate("company.delete");
        
        $permissions[] = Permission::findOrCreate("platoon.view");
        $permissions[] = Permission::findOrCreate("platoon.create");
        $permissions[] = Permission::findOrCreate("platoon.update");
        $permissions[] = Permission::findOrCreate("platoon.delete");

        $permissions[] = Permission::findOrCreate("squad.view");
        $permissions[] = Permission::findOrCreate("squad.create");
        $permissions[] = Permission::findOrCreate("squad.update");
        $permissions[] = Permission::findOrCreate("squad.delete");

        $permissions[] = Permission::findOrCreate("fireteam.view");
        $permissions[] = Permission::findOrCreate("fireteam.create");
        $permissions[] = Permission::findOrCreate("fireteam.update");
        $permissions[] = Permission::findOrCreate("fireteam.delete");

        $permissions[] = Permission::findOrCreate("event.view");
        $permissions[] = Permission::findOrCreate("event.create");
        $permissions[] = Permission::findOrCreate("event.update");
        $permissions[] = Permission::findOrCreate("event.delete");

        $permissions[] = Permission::findOrCreate("onboarding.view");
        $permissions[] = Permission::findOrCreate("onboarding.create");
        $permissions[] = Permission::findOrCreate("onboarding.update");
        $permissions[] = Permission::findOrCreate("onboarding.delete");
        $permissions[] = Permission::findOrCreate("onboarding.apply");
        
        $permissions[] = Permission::findOrCreate("inventory.view");
        $permissions[] = Permission::findOrCreate("inventory.create");
        $permissions[] = Permission::findOrCreate("inventory.update");
        $permissions[] = Permission::findOrCreate("inventory.delete");
        
        $permissions[] = Permission::findOrCreate("roles.view");
        $permissions[] = Permission::findOrCreate("roles.create");
        $permissions[] = Permission::findOrCreate("roles.update");
        $permissions[] = Permission::findOrCreate("roles.delete");

        $superAdmin = Role::findOrCreate('Super Admin');
        $superAdmin->givePermissionTo($permissions);

        AppSettings::firstOrCreate([
            'key' => 'installed',
            'value' => false
        ]);
    }
}
