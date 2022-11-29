<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use Illuminate\Database\Seeder;

class CiudadSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::create([
            'codigo'=>'UIO',
            'nombre'=>'Quito',
            'contacto'=>'Contacto Quito',
            'telefono'=>'0995814087'          
        ]);
        Ciudad::create([
            'codigo'=>'GYE',
            'nombre'=>'Guayaquil',
            'contacto'=>'Contacto Guayaquil',
            'telefono'=>'0995814087'          
        ]);
        Ciudad::create([
            'codigo'=>'CUE',
            'nombre'=>'Cuenca',
            'contacto'=>'Contacto Cuenca',
            'telefono'=>'0995814087'          
        ]);
    }
}

