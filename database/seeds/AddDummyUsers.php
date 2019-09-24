<?php

use Illuminate\Database\Seeder;
use App\User;
use App\reservations;

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
        	['id' => '1', 'name' => 'admin', 'email' => 'admin@test.com', 'password' => 'testuser']
        ];
        foreach ($data as $key => $value) {
        	User::create($value);
        }

        factory(App\User::class, 10)->create()->each(function($user) {
            $user->Reservations()->save(factory(App\reservations::class)->make());
        });
    }
}
