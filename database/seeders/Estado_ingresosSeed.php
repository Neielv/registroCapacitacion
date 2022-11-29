<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadoingresos;

class Estado_ingresosSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado1= Estadoingresos::create(['nombre'=>'Generado']);
        $estado2= Estadoingresos::create(['nombre'=>'Registrado']);
        $estado3= Estadoingresos::create(['nombre'=>'Cancelado']);
    }
}
