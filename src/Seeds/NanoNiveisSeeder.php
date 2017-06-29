<?php

use Illuminate\Database\Seeder;

class NanoNiveisSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('nano_niveis')->insert([
            'nivel' => 'admin',
        ]);

        DB::table('nano_niveis')->insert([
            'nivel' => 'user',
        ]);
    }

}
