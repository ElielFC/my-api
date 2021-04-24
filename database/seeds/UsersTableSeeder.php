<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cria usuário padrão admin
        $id = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'control_permissions_by' => 'I',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Libera todas as permissões
        DB::table('permissions')->get()
            ->each(function($permission) use($id) {
                DB::table('user_permission')->insert([
                    'user_id' => $id,
                    'permission_id' => $permission->id
                ]);
            });
    }
}
