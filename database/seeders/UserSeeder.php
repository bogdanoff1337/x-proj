<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//

        $user = new \App\Models\User();
        $user->id = 1;
        $user->steam_id = '76561198877044347';
        $user->nickname = 'Bogdanoff❤ run';
        $user->avatar = 'https://avatars.steamstatic.com/7549765b9b85b41b9c6088e480bfdcbaa4cadcb1_medium.jpg';
        $user->profile_url = 'https://steamcommunity.com/id/Taima/';
        $user->save();
    }
}
