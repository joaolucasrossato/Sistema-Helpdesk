<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        $tickets = [
            [
                'title' => 'Impressora não imprime cupom fiscal',
                'description' => 'A impressora do caixa 2 não está imprimindo o cupom fiscal do sistema.',
                'priority' => 'Alta',
                'status' => 'Aberto',
                'category' => 'Erro Impressora',
            ],
            [
                'title' => 'Sistema apresenta Error 203',
                'description' => 'Ao tentar finalizar uma venda, o sistema retorna "Error 203" e trava.',
                'priority' => 'Alta',
                'status' => 'Em andamento',
                'category' => 'Erro no Sistema',
            ],
            [
                'title' => 'Não consigo acessar minha conta',
                'description' => 'Esqueci a senha e o link de recuperação não chega no e-mail.',
                'priority' => 'Média',
                'status' => 'Resolvido',
                'category' => 'Acesso Bloqueado',
            ],
            [
                'title' => 'Internet lenta no setor financeiro',
                'description' => 'A conexão está caindo constantemente desde ontem.',
                'priority' => 'Baixa',
                'status' => 'Aberto',
                'category' => 'Rede/Internet',
            ],
        ];

        foreach ($tickets as $data) {
            $category = $categories->firstWhere('name', $data['category']);

            $ticket = Ticket::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'priority' => $data['priority'],
                'status' => $data['status'],
                'category_id' => $category->id,
                'user_id' => $user->id,
                'technician_id' => null,
            ]);

            // Adiciona um comentário de exemplo no chamado "Em andamento"
            if ($data['status'] === 'Em andamento') {
                $ticket->comments()->create([
                    'user_id' => $user->id,
                    'message' => 'Já identificamos a causa, aguardando aprovação para aplicar a correção.',
                ]);
            }

            // Chamado resolvido ganha um "histórico" de comentário também
            if ($data['status'] === 'Resolvido') {
                $ticket->comments()->create([
                    'user_id' => $user->id,
                    'message' => 'Problema resolvido, senha redefinida manualmente pelo suporte.',
                ]);
            }
        }
    }
}
