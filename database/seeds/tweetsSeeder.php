<?php

use Illuminate\Database\Seeder;

class tweetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tweets = [
            0 => [
                'usuario_id' => '1',
                'texto_tweet' => 'Joao: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ],
            1 => [
                'usuario_id' => '1',
                'texto_tweet' => 'Joao: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ],
            2 => [
                'usuario_id' => '2',
                'texto_tweet' => 'Maria: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ],
            3 => [
                'usuario_id' => '2',
                'texto_tweet' => 'Maria: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ],
            4 => [
                'usuario_id' => '3',
                'texto_tweet' => 'Susana: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ],
            5 => [
                'usuario_id' => '3',
                'texto_tweet' => 'Susana: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
            ]
        ];

        DB::table('table_tweets')->insert($tweets);
    }
}
