<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Usuario Admin crea un nuevo usuario correctamente.
     *
     * @return void
     */
    public function test_admin_crea_usuario_correctamente()
    {

        $adminUser = User::factory()->create([
            'role' => 'Admin',
            'gym_id' => 1,
            'state' => 'Activo'
        ]);

        $this->actingAs($adminUser);


        $nuevoUsuario = [
            'id' => 12345,
            'name' => 'David',
            'email' => 'david@test.com',
            'gender' => 'M',
            'birth_date' => '1990-01-01',
            'phone_number' => '1234567890',
            'state' => 'Activo',
            'gym_id' => 1
        ];

        $response = $this->post('/admin/users', $nuevoUsuario);


        $response->assertRedirect('/admin/users');

        $this->assertDatabaseHas('users', [
            'email' => 'david@test.com',
            'name' => 'David',
            'gym_id' => 1
        ]);
    }


    public function test_usuario_no_autenticado_redirige_login()
    {
        $response = $this->post('/admin/users', [
            'id' => 54321,
            'name' => 'NoAuth',
            'email' => 'noauth@test.com',
        ]);

        $response->assertRedirect('/login');
    }
}
