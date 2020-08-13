<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User:: create([
        	'name'=>'Joe Prime',
        	'email'=>'joeasewe@gmail.com',
        	'password'=> Hash::make('password'),
        	'role'=>'user',
        	'status'=>'1',
        	'remember_token' =>str_random(10),
        ]);
    }
}
