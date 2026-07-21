<?php

use App\Models\ComplaintCategory;
use App\Models\User;

test('categories page requires authentication', function () {
    $this->get(route('categories.index'))->assertRedirect('/login');
});

test('authenticated user can view categories index', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    ComplaintCategory::factory()->count(3)->create();

    $this->get(route('categories.index'))
        ->assertOk()
        ->assertSee('Kategori Pengaduan');
});

test('authenticated user can create category', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post(route('categories.store'), [
        'nama' => 'Infrastruktur',
        'deskripsi' => 'Pengaduan terkait infrastruktur',
    ])->assertRedirect();

    $this->assertDatabaseHas('complaint_categories', [
        'nama' => 'Infrastruktur',
    ]);
});

test('category validation requires nama', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post(route('categories.store'), [
        'nama' => '',
    ])->assertSessionHasErrors('nama');
});

test('authenticated user can edit category', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();

    $this->put(route('categories.update', $category), [
        'nama' => 'Updated Name',
        'deskripsi' => 'Updated description',
    ])->assertRedirect();

    $this->assertDatabaseHas('complaint_categories', [
        'id' => $category->id,
        'nama' => 'Updated Name',
    ]);
});

test('authenticated user can delete category', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $category = ComplaintCategory::factory()->create();

    $this->delete(route('categories.destroy', $category))->assertRedirect();

    $this->assertSoftDeleted('complaint_categories', [
        'id' => $category->id,
    ]);
});
