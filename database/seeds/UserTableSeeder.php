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
        $data = [
            'email' => 'admin@spkahp.com',
            'name' => 'Admin SPKAHP',
            'email_verified_at' => now(),
            'password'  => bcrypt('p@ssw0rd'),
            'remember_token'   => Str::random(10),
        ];
        DB::table('users')->insert($data);
    }
}
