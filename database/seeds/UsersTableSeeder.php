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
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        \DB::table('users')->truncate();
        // insert
        $arrMix          = [];
        $arrMix['admin'] = '1';
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.con',
            'password' => bcrypt('Admin@123'),
        ]);
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }
}
