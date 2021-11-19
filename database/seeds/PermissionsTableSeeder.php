<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Permission list
         Permission::create(['name' => 'profesionales.index']);
         Permission::create(['name' => 'profesionales.edit']);
         Permission::create(['name' => 'profesionales.show']);
         Permission::create(['name' => 'profesionales.create']);
         Permission::create(['name' => 'profesionales.destroy']);

         //Admin
         $admin = Role::create(['name' => 'Admin']);

         $admin->givePermissionTo([
             'profesionales.index',
             'profesionales.edit',
             'profesionales.show',
             'profesionales.create',
             'profesionales.destroy'
         ]);
         //$admin->givePermissionTo('products.index');
         //$admin->givePermissionTo(Permission::all());

         //Guest
         $guest = Role::create(['name' => 'Profesional']);

         $guest->givePermissionTo([
             'profesionales.index',
             'profesionales.show'
         ]);

         //User Admin
         $user = User::find(1); //Admin
         $user->assignRole('Admin');
    }
}
