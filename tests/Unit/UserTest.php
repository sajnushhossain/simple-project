<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('returns the correct avatar url', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'test@example.com'
    ]);
    $name = urlencode('John Doe');
    $this->assertEquals("https://unavatar.io/test@example.com?fallback=https://ui-avatars.com/api/?name={$name}&color=7F9CF5&background=EBF4FF", $user->getAvatarUrl());
});
