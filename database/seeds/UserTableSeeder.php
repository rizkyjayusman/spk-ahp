<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'email' => 'admin@spkahp.com',
                'name' => 'Admin',
                'email_verified_at' => now(),
                'password'  => bcrypt('p@ssw0rd'),
                'remember_token'   => null,
                'role_id' => 1 , // ADMIN
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'user@spkahp.com',
                'name' => 'User',
                'email_verified_at' => now(),
                'password'  => bcrypt('p@ssw0rd'),
                'remember_token'   => null,
                'role_id' => 2 , // USER
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        DB::table('users')->insert($data);
    }
}
