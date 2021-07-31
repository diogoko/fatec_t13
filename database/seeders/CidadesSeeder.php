<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cidade::factory(5)->create();

        /*
        Cidade::create([
            'nome' => 'bady bassit',
            'estado' => 'sp',
        ]);
        */

        $linhas = file(__DIR__ . '/categorias.txt');
        foreach ($linhas as $x) {
            Cidade::create(['nome' => $x, 'estado' => 'sp']);
        }
    }
}
