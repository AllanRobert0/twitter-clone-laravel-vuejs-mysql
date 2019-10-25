<?php

use Illuminate\Database\Seeder;

class seguindoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seguindo = [
            0 => [
                'usuario_id' => '1',
                'usuario_seguido_id' => '2'
            ],
            1 => [
                'usuario_id' => '2',
                'usuario_seguido_id' => '3'
            ],
            2 => [
                'usuario_id' => '3',
                'usuario_seguido_id' => '1'
            ]
        ];

        DB::table('table_seguindo')->insert($seguindo);
    }
}
