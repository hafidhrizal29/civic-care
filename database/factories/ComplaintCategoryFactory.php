<?php

namespace Database\Factories;

use App\Models\ComplaintCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ComplaintCategory>
 */
class ComplaintCategoryFactory extends Factory
{
    protected $model = ComplaintCategory::class;

    public function definition(): array
    {
        return [
            'nama' => fake('id_ID')->unique()->word(),
            'deskripsi' => fake('id_ID')->sentence(),
        ];
    }
}
