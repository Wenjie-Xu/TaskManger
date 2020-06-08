<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //声明自定义的seeder，这样就可以找得到
        $this->call(StepsTableSeeder::class);
    }
}
