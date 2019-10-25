<?php

use Illuminate\Database\Seeder;

class comentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comentarios = [
            0 => [
                'usuario_id' => '2',
                'tweet_id' => '1',
                'texto_comentario' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
            ],
            1 => [
                'usuario_id' => '3',
                'tweet_id' => '1',
                'texto_tweet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
            ],
            2 => [
                'usuario_id' => '1',
                'tweet_id' => '3',
                'texto_tweet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
            ],
            3 => [
                'usuario_id' => '3',
                'tweet_id' => '3',
                'texto_tweet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
            ],
            4 => [
                'usuario_id' => '1',
                'tweet_id' => '5',
                'texto_tweet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ],
            5 => [
                'usuario_id' => '2',
                'tweet_id' => '5',
                'texto_tweet' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ]
        ];

        DB::table('table_comentarios')->insert($comentarios);
    }
}
