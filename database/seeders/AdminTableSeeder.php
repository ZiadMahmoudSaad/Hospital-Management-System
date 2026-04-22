<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('admins')->delete();
            DB::table('admins')->insert([
            'name' => 'ziad Mahmoud Saad',
            'email' =>'ziadmahmoud55500@gmail.com',
            'password' => Hash::make('01234567'),
        ]);
    }
}
