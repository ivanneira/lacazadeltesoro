<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'      => 'admin',
            'lastname'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123456789'),
            'active'    => 1

        ]);

        //factory(App\User::class, 7)->create();
    }
}
