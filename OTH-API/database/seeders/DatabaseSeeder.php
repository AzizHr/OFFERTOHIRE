<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Follower;
use App\Models\Offer;
use App\Models\OfferApplication;
use App\Models\OfferLike;
use App\Models\PostLike;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserMessage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PostLike::factory(6)->create();
        OfferLike::factory(6)->create();
        Follower::factory(6)->create();
        OfferApplication::factory(6)->create();
        UserMessage::factory(6)->create();
        Skill::factory(6)->create();
    }
}
