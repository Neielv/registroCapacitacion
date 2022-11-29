<?php

namespace App\Imports;

use App\Models\Ingreso_Producto;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Ingreso_ProductoImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
        $ingreso_id = session('ingreso_id');
        $producto = Producto::where('codigo', $row['codigo'])->first();

        return new Ingreso_Producto([
            'ingreso_id'=> $ingreso_id,
            'producto_id'=>$producto->id,
            'cantidad'=> $row['unidades'],
        ]);
    }
}
