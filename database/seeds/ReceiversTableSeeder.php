<?php

use App\Models\Receiver;
use Illuminate\Database\Seeder;

class ReceiversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Receiver::class, 50)->create();
    }
}
