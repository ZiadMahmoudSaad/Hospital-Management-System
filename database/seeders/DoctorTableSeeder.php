<?php

namespace Database\Seeders;

use App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Doctor;
use App\Models\Image;
use App\Models\Appointment;
class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::factory()->count(30)->create();
        Doctor::all()->each(function ($doctor) {
            Image::create([
                'file_name' => fake()->randomElement(['1.jpg', '2.jpg', '3.jpg']),
                'imageable_id' => $doctor->id,
                'imageable_type' => 'App\Models\Doctor',
                ]);
        });
        $Appointments = Appointment::all();

//        foreach ($doctors as $doctor){
//            $Appointments = Appointment::all()->random()->id;
//            $doctor->doctorappointments()->attach($Appointments);
//        }
        Doctor::all()->each(function ($doctor) use ($Appointments) {
            $doctor->doctorappointments()->attach(
                $Appointments->random(rand(1,7))->pluck('id')->toArray()
            );
              });
        // Image::factory()->count(30)->create();
    }
}
