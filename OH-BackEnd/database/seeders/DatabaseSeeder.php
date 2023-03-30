<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apply;
use App\Models\Follow;
use App\Models\Message;
use App\Models\OfferLike;
use App\Models\PostLike;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Skill::factory(6)->create();
        Follow::factory(10)->create();
        PostLike::factory(6)->create();
        OfferLike::factory(6)->create();
        Message::factory(10)->create();
        Apply::factory(8)->create();
    }
}
