<?php

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\User;

test('complaints page requires authentication', function () {
    $this->get(route('complaints.index'))->assertRedirect('/login');
});

test('authenticated user can view complaints index', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->count(3)->create(['complaint_category_id' => $category->id]);

    $this->get(route('complaints.index'))
        ->assertOk()
        ->assertSee('Pengaduan');
});

test('complaints index can filter by status', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->baru()->create(['complaint_category_id' => $category->id]);
    Complaint::factory()->selesai()->create(['complaint_category_id' => $category->id]);

    $this->get(route('complaints.index', ['status' => 'baru']))
        ->assertOk()
        ->assertSee('Baru');

    $this->get(route('complaints.index', ['status' => 'selesai']))
        ->assertOk()
        ->assertSee('Selesai');
});

test('complaints index can search by ticket number', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'judul' => 'Jalan rusak parah',
    ]);

    $this->get(route('complaints.index', ['search' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertSee('Jalan rusak parah');
});

test('authenticated user can view complaint create form', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    ComplaintCategory::factory()->count(3)->create();

    $this->get(route('complaints.create'))
        ->assertOk()
        ->assertSee('Buat Pengaduan');
});

test('authenticated user can store complaint', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();

    $this->post(route('complaints.store'), [
        'judul' => 'Lampu jalan mati',
        'complaint_category_id' => $category->id,
        'nama_pelapor' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'telepon' => '081234567890',
        'lokasi' => 'Jl. Merdeka No. 10',
        'deskripsi' => 'Lampu jalan sudah mati selama 3 hari',
    ])->assertRedirect();

    $this->assertDatabaseHas('complaints', [
        'judul' => 'Lampu jalan mati',
        'nama_pelapor' => 'Budi Santoso',
    ]);
});

test('complaint store validates required fields', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post(route('complaints.store'), [
        'judul' => '',
        'complaint_category_id' => '',
        'nama_pelapor' => '',
        'lokasi' => '',
        'deskripsi' => '',
    ])->assertSessionHasErrors(['judul', 'complaint_category_id', 'nama_pelapor', 'lokasi', 'deskripsi']);
});

test('complaint ticket number is auto generated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();

    $this->post(route('complaints.store'), [
        'judul' => 'Sampah menumpuk',
        'complaint_category_id' => $category->id,
        'nama_pelapor' => 'Siti Rahayu',
        'lokasi' => 'Jl. Sudirman',
        'deskripsi' => 'Tumpukan sampah di pinggir jalan',
    ]);

    $complaint = Complaint::where('judul', 'Sampah menumpuk')->first();
    expect($complaint->nomor_tiket)->toStartWith('CC-');
});

test('complaint status defaults to baru', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();

    $this->post(route('complaints.store'), [
        'judul' => 'Banjir',
        'complaint_category_id' => $category->id,
        'nama_pelapor' => 'Ahmad',
        'lokasi' => 'Kelurahan A',
        'deskripsi' => 'Banjir setinggi 50cm',
    ]);

    $complaint = Complaint::where('judul', 'Banjir')->first();
    expect($complaint->status)->toBe('baru');
});

test('authenticated user can view complaint detail', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);

    $this->get(route('complaints.show', $complaint))
        ->assertOk()
        ->assertSee($complaint->nomor_tiket);
});

test('authenticated user can update complaint', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);

    $this->put(route('complaints.update', $complaint), [
        'judul' => 'Updated Title',
        'complaint_category_id' => $category->id,
        'nama_pelapor' => $complaint->nama_pelapor,
        'lokasi' => $complaint->lokasi,
        'deskripsi' => $complaint->deskripsi,
        'status' => 'diproses',
    ])->assertRedirect();

    $this->assertDatabaseHas('complaints', [
        'id' => $complaint->id,
        'judul' => 'Updated Title',
        'status' => 'diproses',
    ]);
});

test('authenticated user can delete complaint', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);

    $this->delete(route('complaints.destroy', $complaint))->assertRedirect();

    $this->assertSoftDeleted('complaints', [
        'id' => $complaint->id,
    ]);
});

test('complaint status can be updated via patch', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'status' => 'baru',
    ]);

    $this->patch(route('complaints.status', $complaint), [
        'status' => 'selesai',
    ])->assertRedirect();

    $this->assertDatabaseHas('complaints', [
        'id' => $complaint->id,
        'status' => 'selesai',
    ]);
});
