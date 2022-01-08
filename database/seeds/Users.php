<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Paulo Vital',
            'email' => 'pauloavital@gmail.com',
            'password' => '$2y$10$hGv2owV5e8mxy88PG8zvquytxqAUqo4Mx9EGjal0cjbPK6901OhOS' // 123456789
        ]);
    }
}
