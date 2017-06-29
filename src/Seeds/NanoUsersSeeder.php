<?php

use Illuminate\Database\Seeder;

class NanoUsersSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('nano_users')->insert([
            'name' => 'Usuario Teste',
            'email' => 'teste@teste.com',
            'login' => 'teste',
            'password' => Hash::make('teste1234'),
            'nivel' => 1,
            'nascimento' => '2017-01-01',
            'endereco' => '',
            'bairro' => '',
            'cidade' => '',
            'uf' => ''
        ]);
    }

}
