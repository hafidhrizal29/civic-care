<?php

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\User;

test('reports page requires authentication', function () {
    $this->get(route('reports.index'))->assertRedirect('/login');
});

test('authenticated user can view reports page', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->count(3)->create(['complaint_category_id' => $category->id]);

    $this->get(route('reports.index'))
        ->assertOk()
        ->assertSee('Laporan');
});

test('reports page shows correct total count', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->count(5)->create(['complaint_category_id' => $category->id]);

    $this->get(route('reports.index'))
        ->assertOk()
        ->assertSee('Total Pengaduan');
});

test('reports can filter by status', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->baru()->count(2)->create(['complaint_category_id' => $category->id]);
    Complaint::factory()->selesai()->count(3)->create(['complaint_category_id' => $category->id]);

    $this->get(route('reports.index', ['status' => 'baru']))
        ->assertOk();

    $this->get(route('reports.index', ['status' => 'selesai']))
        ->assertOk();
});

test('reports can filter by category', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $cat1 = ComplaintCategory::factory()->create(['nama' => 'Infrastruktur']);
    $cat2 = ComplaintCategory::factory()->create(['nama' => 'Kebersihan']);
    Complaint::factory()->count(3)->create(['complaint_category_id' => $cat1->id]);
    Complaint::factory()->count(2)->create(['complaint_category_id' => $cat2->id]);

    $this->get(route('reports.index', ['category' => $cat1->id]))
        ->assertOk();
});

test('reports can filter by date range', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'created_at' => now()->subDays(10),
    ]);
    Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'created_at' => now()->subDays(1),
    ]);

    $this->get(route('reports.index', [
        'date_from' => now()->subDays(5)->format('Y-m-d'),
        'date_to' => now()->format('Y-m-d'),
    ]))->assertOk();
});

test('reports export requires authentication', function () {
    $this->get(route('reports.export'))->assertRedirect('/login');
});

test('authenticated user can export csv', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->count(3)->create(['complaint_category_id' => $category->id]);

    $response = $this->get(route('reports.export'));
    $response->assertOk();
});

test('export csv contains correct headers', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);

    $response = $this->get(route('reports.export'));
    $content = $response->streamedContent();

    expect($content)->toContain('Nomor Tiket');
    expect($content)->toContain('Judul');
    expect($content)->toContain('Kategori');
    expect($content)->toContain($complaint->nomor_tiket);
});

test('export csv respects filters', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $included = Complaint::factory()->create(['complaint_category_id' => $category->id]);
    $excluded = Complaint::factory()->create(['complaint_category_id' => $category->id]);

    $response = $this->get(route('reports.export', ['status' => $included->status]));
    $content = $response->streamedContent();

    expect($content)->toContain($included->nomor_tiket);
});
