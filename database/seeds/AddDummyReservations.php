<?php

use App\reservations;
use Illuminate\Database\Seeder;

class AddDummyReservations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create dummy reservations
        
        // $data = [
        //     ['user_id' => '1', 'reservation_name'=>'Demo Reservation-1', 'start'=>'2019-09-16 10:00:00', 'end'=>'2019-09-16 11:00:00'],
        //     ['user_id' => '1', 'reservation_name'=>'Demo Reservation-3', 'start'=>'2019-09-16 13:00:00', 'end'=>'2019-09-16 14:00:00'],
        // 	['user_id' => '1', 'reservation_name'=>'Demo Reservation-2', 'start'=>'2019-09-17 12:00:00', 'end'=>'2019-09-17 13:00:00'],
        // 	['user_id' => '1', 'reservation_name'=>'Demo Reservation-4', 'start'=>'2019-09-18 10:00:00', 'end'=>'2019-09-18 12:00:00'],
        // 	['user_id' => '1', 'reservation_name'=>'Demo Reservation-5', 'start'=>'2019-09-19 13:00:00', 'end'=>'2019-09-19 14:00:00'],
        // ];
        // foreach ($data as $key => $value) {
        // 	reservations::create($value);
        // }

        factory(App\reservations::class, 10)->make();
    }
}
