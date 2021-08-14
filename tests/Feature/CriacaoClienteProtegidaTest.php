<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CriacaoClienteProtegidaTest extends TestCase
{
    public function test_formulario_bloqueado_usuario_anonimo()
    {
        $response = $this->get('/clientes/novo');

        $response->assertStatus(302);
    }

    public function test_formulario_aberto_usuario_logado() {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/clientes/novo');

        $response->assertStatus(200);
    }
}
