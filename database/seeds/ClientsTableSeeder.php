<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Clients;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Clients::create([
           'clientid'=> '001',
           'clientname'=>'Kenya Commercial Bank',
           'address'=>'Kencom House, Moi Avenue',
           'contact'=>'Moses Kiranga',
           'phone'=>'0705478987',
           'email'=>'mkiranga@kcbgroup.co.ke',
           'email_1'=>'rsang@kcbgroup.co.ke',
           'email_2'=>'dchege@kcbgroup.co.ke',
           'status'=> 'Active'
       ]);
    }
}
