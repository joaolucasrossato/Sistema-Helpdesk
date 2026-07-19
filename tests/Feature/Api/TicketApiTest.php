<?php

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;

test('login retorna um token válido', function () {
    $user = User::factory()->create([
        'password' => bcrypt('senha123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'senha123',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure(['user', 'token']);
});

test('não é possível listar chamados sem autenticação', function () {
    $response = $this->getJson('/api/tickets');

    $response->assertStatus(401);
});

test('usuário autenticado pode listar chamados via API', function () {
    $user = User::factory()->create();
    Ticket::factory()->count(3)->create();

    $response = $this->actingAs($user, 'sanctum')->getJson('/api/tickets');

    $response->assertStatus(200)
        ->assertJsonCount(3);
});

test('usuário autenticado pode criar chamado via API', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this->actingAs($user, 'sanctum')->postJson('/api/tickets', [
        'title' => 'Teste via API',
        'description' => 'Criado nos testes automatizados',
        'priority' => 'Média',
        'category_id' => $category->id,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('tickets', ['title' => 'Teste via API']);
});
