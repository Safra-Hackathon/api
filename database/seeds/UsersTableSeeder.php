<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Admin User',
            'email'             => 'admin@admin.com',
            'account_id'        => null,
            'password'          => Hash::make('1234'),
        ]);


        User::create([
            'name'              => 'Susan Wojcicki da Silva',
            'email'             => 'susan@gmail.com',
            'account_id'        => '00711234511',
            'password'          => Hash::make('1234'),
        ]);

        User::create([
            'name'              => 'Satya Nadella da Silva',
            'email'             => 'satya@gmail.com',
            'account_id'        => '12345678901222',
            'password'          => Hash::make('1234'),
        ]);

        User::create([
            'name'              => 'Mark Zuckerberg da Silva',
            'email'             => 'mark@gmail.com',
            'account_id'        => '00711234533',
            'password'          => Hash::make('1234'),
        ]);

    }
}
