<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = factory(User::class)->times(30)->make();
        User::insert($users->makeVisible('password','remember_token')->toArray());
        $user = User::find(1);
        $user->name = 'Liuhaiqiang';
        $user->email = '857523518@qq.com';
        $user->is_admin = 1;
        $user->save();
    }
}
