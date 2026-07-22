<?php

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\Response;
use App\Models\User;

test('responses page requires authentication', function () {
    $this->get(route('responses.index'))->assertRedirect('/login');
});

test('authenticated user can view responses index', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);
    Response::factory()->create([
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
    ]);

    $this->get(route('responses.index'))
        ->assertOk()
        ->assertSee('Tanggapan');
});

test('responses index can search by ticket number', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create([
        'complaint_category_id' => $category->id,
        'judul' => 'Banjir parah',
    ]);
    Response::factory()->create([
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
    ]);

    $this->get(route('responses.index', ['search' => $complaint->nomor_tiket]))
        ->assertOk()
        ->assertSee('Banjir parah');
});

test('authenticated user can view response create form', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    Complaint::factory()->count(2)->create(['complaint_category_id' => $category->id]);

    $this->get(route('responses.create'))
        ->assertOk()
        ->assertSee('Kirim Tanggapan');
});

test('create form only shows open complaints', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $openComplaint = Complaint::factory()->baru()->create(['complaint_category_id' => $category->id]);
    $closedComplaint = Complaint::factory()->selesai()->create(['complaint_category_id' => $category->id]);

    $this->get(route('responses.create'))
        ->assertOk()
        ->assertSee($openComplaint->nomor_tiket)
        ->assertDontSee($closedComplaint->nomor_tiket);
});

test('authenticated user can store response', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);

    $this->post(route('responses.store'), [
        'complaint_id' => $complaint->id,
        'isi' => 'Kami akan segera menindaklanjuti pengaduan ini.',
    ])->assertRedirect();

    $this->assertDatabaseHas('responses', [
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
        'isi' => 'Kami akan segera menindaklanjuti pengaduan ini.',
    ]);
});

test('response store validates required fields', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post(route('responses.store'), [
        'complaint_id' => '',
        'isi' => '',
    ])->assertSessionHasErrors(['complaint_id', 'isi']);
});

test('creating response auto-updates complaint status from baru to diproses', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->baru()->create(['complaint_category_id' => $category->id]);

    expect($complaint->status)->toBe('baru');

    $this->post(route('responses.store'), [
        'complaint_id' => $complaint->id,
        'isi' => 'Tanggapan pertama.',
    ]);

    $complaint->refresh();
    expect($complaint->status)->toBe('diproses');
});

test('creating response does not change already processed complaint', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->diproses()->create(['complaint_category_id' => $category->id]);

    $this->post(route('responses.store'), [
        'complaint_id' => $complaint->id,
        'isi' => 'Tanggapan tambahan.',
    ]);

    $complaint->refresh();
    expect($complaint->status)->toBe('diproses');
});

test('authenticated user can view response edit form', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);
    $response = Response::factory()->create([
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
    ]);

    $this->get(route('responses.edit', $response))
        ->assertOk()
        ->assertSee('Edit Tanggapan')
        ->assertSee($response->isi);
});

test('authenticated user can update response', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);
    $response = Response::factory()->create([
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
    ]);

    $this->put(route('responses.update', $response), [
        'complaint_id' => $complaint->id,
        'isi' => 'Isi tanggapan yang diperbarui.',
    ])->assertRedirect();

    $this->assertDatabaseHas('responses', [
        'id' => $response->id,
        'isi' => 'Isi tanggapan yang diperbarui.',
    ]);
});

test('authenticated user can delete response', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();
    $complaint = Complaint::factory()->create(['complaint_category_id' => $category->id]);
    $response = Response::factory()->create([
        'complaint_id' => $complaint->id,
        'user_id' => $user->id,
    ]);

    $this->delete(route('responses.destroy', $response))->assertRedirect();

    $this->assertDatabaseMissing('responses', [
        'id' => $response->id,
    ]);
});
