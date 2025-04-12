<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'over_name' => '田中',
            'under_name' => '美沙希',
            'over_name_kana' => 'タナカ',
            'under_name_kana' => 'ミサキ',
            'mail_address' => 'misaki.tanaka@tanaka.com',
            'sex' => '2',
            'birth_day' => '1991-08-27',
            'role' => '2',
            'password' =>bcrypt('00000000'),
        ]);
    }
}
