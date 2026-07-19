<?php

use App\Models\Ticket;
use App\Models\User;

test('usuário autenticado pode comentar em um chamado', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create();

    $response = $this->actingAs($user)->post("/tickets/{$ticket->id}/comments", [
        'message' => 'Já verifiquei o problema, aguardando peça.',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('comments', [
        'ticket_id' => $ticket->id,
        'user_id' => $user->id,
        'message' => 'Já verifiquei o problema, aguardando peça.',
    ]);
});
