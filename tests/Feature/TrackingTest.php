<?php

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Response;
use App\Models\User;

test('tracking page is accessible without authentication', function () {
    $this->get(route('tracking'))->assertOk();
});

test('tracking page shows search form', function () {
    $this->get(route('tracking'))
        ->assertOk()
        ->assertSee('Lacak Pengaduan')
        ->assertSee('nomor_tiket');
});

test('tracking page shows not found message for invalid ticket', function () {
    $this->get(route('tracking', ['nomor_tiket' => 'CC-00000000-0000']))
        ->assertOk()
        ->assertSee('Pengaduan tidak ditemukan');
});

test('tracking page shows complaint detail for valid ticket', function () {
    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'judul' => 'Jalan berlubang',
    ]);

    $this->get(route('tracking', ['nomor_tiket' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertSee('Jalan berlubang')
        ->assertSee($complaint->nomor_tiket);
});

test('tracking page shows complaint status', function () {
    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->diproses()->create([
        'complaint_category_id' => $category->id,
    ]);

    $this->get(route('tracking', ['nomor_tiket' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertSee('Diproses');
});

test('tracking page shows responses timeline', function () {
    $user = User::factory()->create();
    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);
    Response::factory()->create([
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
        'isi' => 'Kami sudah menerima pengaduan Anda.',
    ]);

    $this->get(route('tracking', ['nomor_tiket' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertSee('Riwayat Tanggapan')
        ->assertSee('Kami sudah menerima pengaduan Anda.');
});

test('tracking page shows complaint photo when available', function () {
    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'foto' => 'complaints/test-photo.jpg',
    ]);

    $this->get(route('tracking', ['nomor_tiket' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertSee('Foto Bukti');
});

test('tracking page does not show photo section when empty', function () {
    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'foto' => null,
    ]);

    $this->get(route('tracking', ['nomor_tiket' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertDontSee('Foto Bukti');
});
