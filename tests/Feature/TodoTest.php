<?php

test('user should be able to create todo', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this->actingAs($user)->post(route('todos.store'), [
        'title' => 'Test Todo',
        'description' => 'Test Description',
    ]);

    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseCount('todos', 1);
});

test('user should not be able to  create todo for another user', function () {
    $user = \App\Models\User::factory()->create();
    $user2 = \App\Models\User::factory()->create();

    $response = $this->actingAs($user)->post(route('todos.store'), [
        'title' => 'Test Todo',
        'description' => 'Test Description',
        'user_id' => $user2->id, // <--- change user_id to another user for test
    ]);

    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseCount('todos', 1);

    $this->assertDatabaseMissing('todos', [
        'user_id' => $user2->id,
    ]);
});

test('user should be able to delete todo', function () {
    $user = \App\Models\User::factory()->create();
    $todo = \App\Models\Todo::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->delete(route('todos.destroy', [$todo->id]));

    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseCount('todos', 0);
});

test('user should not be able to  delete another user\'s todo', function () {
    $user = \App\Models\User::factory()->create();
    $user2 = \App\Models\User::factory()->create();
    $todo = \App\Models\Todo::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user2)->delete(route('todos.destroy', [$todo->id]));

    $response->assertStatus(403);
});



test('user should be able to update todo', function () {
    $user = \App\Models\User::factory()->create();
    $todo = \App\Models\Todo::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->post(route('todos.update', [$todo->id]), [
        'title' => 'Test Todo',
        'description' => 'Test Description',
    ]);

    $response->assertRedirect(route('dashboard'));

    $this->assertDatabaseHas('todos', [
        'title' => 'Test Todo',
        'description' => 'Test Description',
    ]);
});

test('user should not be able to  update another user\'s todo', function () {
    $user = \App\Models\User::factory()->create();
    $user2 = \App\Models\User::factory()->create();
    $todo = \App\Models\Todo::factory()->create([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user2)->post(route('todos.update', [$todo->id]), [
        'title' => 'Test Todo',
        'description' => 'Test Description',
    ]);

    $response->assertStatus(403);
});
