<?php

test('user can be login if is active', function () {
    $user = \App\Models\User::factory()->create([
        'is_active' => 1,
    ]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
});

test('user can\'t be login if is inactive', function () {
    $user = \App\Models\User::factory()->create([
        'is_active' => 0,
    ]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('login'));
});
