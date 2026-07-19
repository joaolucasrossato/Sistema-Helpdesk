<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Erro Impressora', 'description' => 'Problemas com impressão, papel travado ou toner'],
            ['name' => 'Erro no Sistema', 'description' => 'Falhas ou erros em sistemas internos'],
            ['name' => 'Acesso Bloqueado', 'description' => 'Problemas de login ou permissão de acesso'],
            ['name' => 'Rede/Internet', 'description' => 'Instabilidade ou queda de conexão'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
