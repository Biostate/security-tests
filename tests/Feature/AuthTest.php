<?php

test('user should be able to login if is active', function () {
    $user = \App\Models\User::factory()->create([
        'is_active' => 1,
    ]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
});

test('user should not be able to login if is inactive', function () {
    $user = \App\Models\User::factory()->create([
        'is_active' => 0,
    ]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertSessionHasErrors('email');
});

test('user should not be able to see dashboard if is not logged in', function () {
    $response = $this->get(route('dashboard'));

    $response->assertRedirect(route('login'));
});
