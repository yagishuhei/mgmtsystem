<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\SUpport\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Str::random(8);
        print "こちら管理者です"."\n";
        print "メールアドレスはAdmin@email.comです"."\n";
        print "パスワードは".$password."です"."\n";
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'Initial@email.com',
            'password' => Hash::make($password),
        ]);
    }
}
