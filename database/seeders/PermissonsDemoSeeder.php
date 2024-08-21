<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissonsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'show dashboard']);
        Permission::create(['name' => 'show map']);
        Permission::create(['name' => 'show lokasi']);
        Permission::create(['name' => 'show transportasi']);
        Permission::create(['name' => 'show pengangkutan']);
        Permission::create(['name' => 'show pengangkutan-harga']);
        Permission::create(['name' => 'show pengangkutan-filter']);
        Permission::create(['name' => 'create pengangkutan']);
        Permission::create(['name' => 'show laporan']);
        Permission::create(['name' => 'show profile']);


        // create roles and assign existing permissions
        $administrator = Role::create(['name' => 'Administrator']);

        $user = Role::create(['name' => 'Operasional']);
        $user->givePermissionTo([
            'show dashboard',
            'show pengangkutan',
            'create pengangkutan',
            'show map']);

        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users

        $administrator1 = User::factory()->create([
            'name' => 'admin',
            'password'=>'password',
            'email' => 'admin@app.com'
        ]);
        $administrator1->assignRole($administrator);

        $user1 = User::factory()->create([
            'name' => 'user1',
            'password' => 'password',
            'email' => 'user1@app.com'
        ]);
        $user1->assignRole($user);

        $pimpinan = Role::create(['name' => 'Pimpinan']);
        $pimpinan->givePermissionTo([
            'show dashboard',
        'show pengangkutan',
            'show pengangkutan-harga',
            'show pengangkutan-filter',
        ]);

        $pimpinan1 = User::factory()->create([
            'name' => 'pimpinan1',
            'password' => 'password',
            'email' => 'pimpinan1@app.com'
        ]);
        $pimpinan1->assignRole($pimpinan);

    }
}
