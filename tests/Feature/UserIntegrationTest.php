<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
public function test_usuario_crea_correctamente()
{
    $response = $this->post('/admin/users', [
        'name' => 'David',
        'email' => 'david@test.com',
        'gender' => 'M',
        'birth_date' => '1990-01-01',
        'phone_number' => '1234567890',
        'state' => 'Activo',
        'id' => 12345,
        'gym_id' => 1,
    ]);

    $response->assertRedirect('/admin/users');
    $this->assertDatabaseHas('users', ['email' => 'david@test.com']);
}
}
