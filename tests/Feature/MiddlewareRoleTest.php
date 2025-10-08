<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class MiddlewareRoleTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function permite_acceso_si_el_usuario_admin_tiene_el_rol_correcto(): void
    {
 
        $user = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(), 
        ]);

        $this->actingAs($user)
             ->get('/dashboard')
             ->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function bloquea_acceso_si_el_usuario_admin_no_tiene_el_rol_requerido(): void
    {
        $user = User::factory()->create([
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
             ->get('/admin') 
             ->assertStatus(403);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function permite_acceso_si_el_usuario_receptionist_tiene_el_rol_correcto(): void
    {
        $user = User::factory()->create([
            'role' => 'receptionist',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
             ->get('/receptionist/dashboard')
             ->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function bloquea_acceso_si_el_usuario_receptionist_no_tiene_el_rol_requerido(): void
    {
        $user = User::factory()->create([
            'role' => 'cliente',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user)
             ->get('/receptionist/dashboard')
             ->assertStatus(403);
    }
}
