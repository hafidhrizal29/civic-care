<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Response;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    public function run(): void
    {
        $adminIds = User::pluck('id');
        $complaintIds = Complaint::pluck('id');

        Response::factory()
            ->count(500)
            ->sequence(fn () => [
                'complaint_id' => $complaintIds->random(),
                'user_id' => $adminIds->random(),
            ])
            ->create();
    }
}
