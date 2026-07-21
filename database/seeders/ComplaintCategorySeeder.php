<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use Illuminate\Database\Seeder;

class ComplaintCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama' => 'Infrastruktur', 'deskripsi' => 'Pengaduan terkait kerusakan jalan, jembatan, gedung, dan fasilitas umum lainnya.'],
            ['nama' => 'Kebersihan', 'deskripsi' => 'Pengaduan terkait kebersihan lingkungan, pengelolaan sampah, dan sanitasi.'],
            ['nama' => 'Keamanan', 'deskripsi' => 'Pengaduan terkait keamanan lingkungan, tindak kriminal, dan ketertiban umum.'],
            ['nama' => 'Lingkungan', 'deskripsi' => 'Pengaduan terkait kerusakan lingkungan, pencemaran, dan konservasi alam.'],
            ['nama' => 'Pelayanan Publik', 'deskripsi' => 'Pengaduan terkait kualitas layanan pemerintah dan instansi publik.'],
            ['nama' => 'Kesehatan', 'deskripsi' => 'Pengaduan terkait fasilitas kesehatan, pelayanan medis, dan kesehatan masyarakat.'],
            ['nama' => 'Pendidikan', 'deskripsi' => 'Pengaduan terkait fasilitas pendidikan, kualitas pengajaran, dan akses pendidikan.'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Pengaduan yang tidak termasuk dalam kategori lainnya.'],
        ];

        foreach ($categories as $category) {
            ComplaintCategory::create($category);
        }
    }
}
