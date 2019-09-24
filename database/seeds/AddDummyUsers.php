<?php

use Illuminate\Database\Seeder;
use App\User;

class AddDummyUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
        	['id' => '1', 'name' => 'admin', 'email' => 'admin@local.com', 'password' => 'admin'],
        	['id' => '2', 'name' => 'test user', 'email' => 'test@test.com', 'password' => 'testuser'],
        ];
        foreach ($data as $key => $value) {
        	User::create($value);
        }
    }
}
