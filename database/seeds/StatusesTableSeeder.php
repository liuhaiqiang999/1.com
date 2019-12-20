<?php

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取用户的IDS
        $user_ids = User::all()->pluck('id')->toArray();
        $faker = app(Faker\Generator::class);
        $statuses = factory(Status::class)->times(500)->make()->each(function ($status) use ($faker,$user_ids){
            $status->user_id = $faker->randomElement($user_ids);
        });


        Status::insert($statuses->toArray());
    }
}
