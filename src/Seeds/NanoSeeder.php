<?php

use Illuminate\Database\Seeder;

class NanoSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {       
        $this->call(NanoNiveisSeeder::class);
        $this->call(NanoNvaccessSeeder::class);
        $this->call(NanoUsersSeeder::class);
    }

}
