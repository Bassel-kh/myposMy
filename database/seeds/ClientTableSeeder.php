<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        $clients = ['ahmed', 'mohamed'];

        foreach ($clients as $client) {

            \App\Models\Client::create([
                'name' => $client,
                'phone' => '011111112',
                'address' => 'haram',
            ]);

        }//end of foreach

    }//end of run
}
