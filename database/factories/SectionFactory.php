<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Section;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    protected $model = Section::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->unique()->randomElement(['قسم المخ والاعصاب','قسم الجراحة','قسم الاطفال','قسم النساء والتوليد','قسم العيون','قسم الباطنة','قسم الاسنان','قسم الجلدية','قسم القلب','قسم الانف والاذن والحنجرة']),
            'description'=>$this->faker->paragraph,
        ];
    }
}
