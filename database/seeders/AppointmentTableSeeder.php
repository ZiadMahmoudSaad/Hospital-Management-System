<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('appointments')->delete();

        $appointments = [
        ['ar' => 'السبت', 'en' => 'Saturday'],
        ['ar' => 'الاحد', 'en' => 'Sunday'],
        ['ar' => 'الاثنين', 'en' => 'Monday'],
        ['ar' => 'الثلاثاء', 'en' => 'Tuesday'],
        ['ar' => 'الاربعاء', 'en' => 'Wednesday'],
        ['ar' => 'الخميس', 'en' => 'Thursday'],
        ['ar' => 'الجمعة', 'en' => 'Friday'],
        ];

        foreach ($appointments as $day) {
            // dd($day);
            Appointment::create([
                'en' => [
                    'name' => $day['en'],
                ],
                'ar' => [
                    'name' => $day['ar'],
                ]
            ]);
        }

    }
}
