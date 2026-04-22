<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Doctor;
use App\Models\Section;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'en' => [
                'name' => fake()->name(),
            ],
            'ar' => [
                'name' => fake('ar_EG')->name(),

            ],
            // 'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->phoneNumber,
            'fees' => $this->faker->randomElement([100, 200, 300, 400, 500]),
            'section_id' => Section::all()->random()->id,
            // 'appointments' => $this->faker->randomElement(['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday']),
        ];
    }
}
