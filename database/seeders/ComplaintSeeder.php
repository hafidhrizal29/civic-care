<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = ComplaintCategory::pluck('id');
        $statuses = ['baru', 'diproses', 'selesai', 'ditolak'];
        $statusWeights = [20, 30, 40, 10];
        $prefix = 'CC-'.now()->format('Ymd');

        for ($i = 1; $i <= 300; $i++) {
            Complaint::create([
                'complaint_category_id' => $categoryIds->random(),
                'nomor_tiket' => $prefix.'-'.str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                'judul' => fake('id_ID')->sentence(4),
                'nama_pelapor' => fake('id_ID')->name(),
                'email' => fake('id_ID')->safeEmail(),
                'telepon' => fake('id_ID')->phoneNumber(),
                'lokasi' => fake('id_ID')->address(),
                'deskripsi' => fake('id_ID')->paragraph(3),
                'status' => $this->weightedRandom($statuses, $statusWeights),
            ]);
        }
    }

    private function weightedRandom(array $items, array $weights): string
    {
        $totalWeight = array_sum($weights);
        $random = mt_rand(1, $totalWeight);
        $cumulative = 0;

        foreach ($items as $index => $item) {
            $cumulative += $weights[$index];
            if ($random <= $cumulative) {
                return $item;
            }
        }

        return $items[0];
    }
}
