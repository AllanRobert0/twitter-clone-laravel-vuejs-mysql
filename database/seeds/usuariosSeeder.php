<?php

use Illuminate\Database\Seeder;

class usuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
            0 => [
                'nome' => 'Joao',
                'email' => 'joao10@hotmail.com',
                'senha' => '654321'
            ],
            1 => [
                'nome' => 'Maria',
                'email' => 'maria10@hotmail.com',
                'senha' => '987654'
            ],
            3 => [
                'nome' => 'Susana',
                'email' => 'susana@gmail.com',
                'senha' => '741258'
            ]
        ];

        DB::table('table_usuarios')->insert($usuarios);
    }
}
