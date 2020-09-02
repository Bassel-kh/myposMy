<?php

use Illuminate\Database\Seeder;
use Laratrust\Traits\LaratrustUserTrait;

class UsersTableSeeder extends Seeder
{
    use LaratrustUserTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'first_name' => 'Super',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminadmin'),
        ]);

        $user->attachRole('super_admin');
    } // end of run

} // end of seeder
