<?php

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;

test('usuário autenticado pode criar um chamado', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this->actingAs($user)->post('/tickets', [
        'title' => 'Impressora não funciona',
        'description' => 'Papel travado na bandeja',
        'priority' => 'Alta',
        'category_id' => $category->id,
    ]);

    $response->assertRedirect('/tickets');
    $this->assertDatabaseHas('tickets', [
        'title' => 'Impressora não funciona',
        'status' => 'Aberto',
        'user_id' => $user->id,
    ]);
});

test('chamado é criado com status Aberto por padrão', function () {
    $ticket = Ticket::factory()->create();

    expect($ticket->status)->toBe('Aberto');
});

test('usuário autenticado pode atualizar o status de um chamado', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create(['status' => 'Aberto']);

    $response = $this->actingAs($user)->put("/tickets/{$ticket->id}", [
        'title' => $ticket->title,
        'description' => $ticket->description,
        'priority' => $ticket->priority,
        'category_id' => $ticket->category_id,
        'status' => 'Em andamento',
    ]);

    $response->assertRedirect('/tickets');
    $this->assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'status' => 'Em andamento',
    ]);
});

test('usuário não autenticado não pode acessar a lista de chamados', function () {
    $response = $this->get('/tickets');

    $response->assertRedirect('/login');
});

test('usuário autenticado pode excluir um chamado', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create();

    $response = $this->actingAs($user)->delete("/tickets/{$ticket->id}");

    $response->assertRedirect('/tickets');
    $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
});
