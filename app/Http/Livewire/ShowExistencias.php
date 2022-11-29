<?php

namespace App\Http\Livewire;
use Barryvdh\DomPDF\Facade as PDF;  
use App\Models\Bodega;
use Livewire\Component;

class ShowExistencias extends Component
{
  
    public $search = ''; 
    public $searchCodigo = ''; 
    public $searchCiudad = ''; 
    public $searchProducto = '';    
    public $sort = 'id';
    public $direction = 'asc';
    protected $listeners = ['render','delete','pdf'];
    public $cant=10;
    public $data_report;

    
    public function render()
    {  
        $productos =Bodega::
        join('productos', function ($join) {
            $join->on('productos.id', '=', 'bodegas.producto_id')
                 ->where('productos.codigo', 'like','%'. $this->searchCodigo.'%');                
        })
        ->join('ciudades', function ($join) {
            $join->on('ciudades.id', '=', 'bodegas.ciudad_id')
                 ->where('ciudades.nombre', 'like','%'. $this->searchCiudad.'%');                
        })
        ->get();


     
        return view('livewire.show-existencias',compact('productos'));
    }

    public function order($sort)
    {
        if ($this->sort = $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function pdf()
    {

        $datos_detalle =Bodega::
        join('productos', function ($join) {
            $join->on('productos.id', '=', 'bodegas.producto_id')
                 ->where('productos.codigo', 'like','%'. $this->searchCodigo.'%');                
        })
        ->join('ciudades', function ($join) {
            $join->on('ciudades.id', '=', 'bodegas.ciudad_id')
                 ->where('ciudades.nombre', 'like','%'. $this->searchCiudad.'%');                
        })
        ->select('productos.id as indice')
        ->selectRaw('productos.codigo as codigo')
        ->selectRaw('productos.nombre as producto')
        ->selectRaw('ciudades.nombre as ciudad')
        ->selectRaw('bodegas.existencia as stock')
        ->get();

        
        $data = [
            'datos'=> 'productos'
            
       ];
     
        $pdfContent = PDF::loadView('livewire.inventariopdf',$data,compact('datos_detalle'))->output();
        return response()->streamDownload(
        fn () => print($pdfContent),
        "inventario.pdf"
            );
    }


}
