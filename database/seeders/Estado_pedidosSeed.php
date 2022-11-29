<?php

namespace Database\Seeders;

use App\Models\Estadoingresos;
use App\Models\Estadopedido;
use Illuminate\Database\Seeder;

class Estado_pedidosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado1= Estadopedido::create(['nombre'=>'Generado']);
        $estado2= Estadopedido::create(['nombre'=>'Cerrado']);     
    }
}
