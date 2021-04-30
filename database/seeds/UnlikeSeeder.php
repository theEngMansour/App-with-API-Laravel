<?php

use Illuminate\Database\Seeder;

class UnlikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Unlike::class, 500)->create();
    }
}
