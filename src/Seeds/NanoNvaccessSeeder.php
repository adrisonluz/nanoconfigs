<?php

use Illuminate\Database\Seeder;

class NanoNvaccessSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('nano_nvaccess')->insert([
            'key' => 'all',
        ]);
    }

}
