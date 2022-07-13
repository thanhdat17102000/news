<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id'=>1,'name'=>'Người dùng','email'=> 'user@gmail.com', 'password'=>'$2a$12$I11cyiVXy84N2sPF2H2M9usmz66ebmFUKf2P.girotGane26fvSxO', 'role'=>'user'],
            ['id'=>2,'name'=>'Quản trị viên','email'=> 'admin@gmail.com', 'password'=>'$2a$12$I11cyiVXy84N2sPF2H2M9usmz66ebmFUKf2P.girotGane26fvSxO', 'role'=>'admin']
        ]);

    }
}
