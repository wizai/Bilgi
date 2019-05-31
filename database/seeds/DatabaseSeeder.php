<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Film::class, 50)->create();
        factory(App\Article::class, 50)->create();
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->films()->save(factory(App\Film::class)->make());
            $user->articles()->save(factory(App\Article::class)->make());
        });
    }
}
