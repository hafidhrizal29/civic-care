<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Complaint>
 */
class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

    public function definition(): array
    {
        $statuses = ['baru', 'diproses', 'selesai', 'ditolak'];

        return [
            'complaint_category_id' => ComplaintCategory::factory(),
            'judul' => fake('id_ID')->sentence(4),
            'nama_pelapor' => fake('id_ID')->name(),
            'email' => fake('id_ID')->safeEmail(),
            'telepon' => fake('id_ID')->phoneNumber(),
            'lokasi' => fake('id_ID')->address(),
            'deskripsi' => fake('id_ID')->paragraph(3),
            'foto' => null,
            'status' => fake()->randomElement($statuses),
        ];
    }

    public function baru(): static
    {
        return $this->state(fn () => ['status' => 'baru']);
    }

    public function diproses(): static
    {
        return $this->state(fn () => ['status' => 'diproses']);
    }

    public function selesai(): static
    {
        return $this->state(fn () => ['status' => 'selesai']);
    }

    public function ditolak(): static
    {
        return $this->state(fn () => ['status' => 'ditolak']);
    }
}
