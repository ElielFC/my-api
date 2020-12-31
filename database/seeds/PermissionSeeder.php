<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            //Usuários
            [
                'name' => 'Listar Usuários',
                'description' => 'Listar todos os Usuários cadastrados.',
                'alias' => 'viewAny-user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ver usuário',
                'description' => 'Ver um usuário cadastrado.',
                'alias' => 'view-user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Criar usuário',
                'description' => 'Criar um cadastro de usuário',
                'alias' => 'store-user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Atualizar usuário',
                'description' => 'Atualizar um cadastro de usuário',
                'alias' => 'update-user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Excluir usuário',
                'description' => 'Excluir um cadastro de usuário',
                'alias' => 'destroy-user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //Funções
            [
                'name' => 'Listar Funções',
                'description' => 'Listar todas as Funções cadastradas.',
                'alias' => 'viewAny-role',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Ver Função',
                'description' => 'Ver uma função cadastrada.',
                'alias' => 'view-role',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Criar Função',
                'description' => 'Criar um cadastro de função',
                'alias' => 'store-role',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Atualizar Função',
                'description' => 'Atualizar um cadastro de função',
                'alias' => 'update-role',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Excluir Função',
                'description' => 'Excluir um cadastro de função',
                'alias' => 'destroy-role',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
