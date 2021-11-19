<?php

use Illuminate\Database\Seeder;

class ContactsTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ContactsTypes::create([
            'name'      => 'Tel',
        ]);

        App\ContactsTypes::create([
            'name'      => 'Cel',
        ]);

        App\ContactsTypes::create([
            'name'      => 'Email',
        ]);
    }
}
